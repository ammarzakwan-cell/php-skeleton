<?php

namespace App\Controllers;

use App\Models\AttendDaily;
use App\Models\EmpBasic;
use RWNA\WorkingHour;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use Throwable;

class HomeController extends Controller
{
    /**
     * Render the home page
     *
     * @param Request $request
     * @param Response $response
     * @param [type] $args
     * @return Response
     */
    public function index(Request $request, Response $response, $args): Response
    {
        return $this->render($response, 'home/index.twig', [
            'appName' => 'hardcoded',
        ]);
    }

    public function employeeAttendDatatable(Request $request, Response $response, $args): Response
    {
        try {
            $request = $request->getQueryParams();
            $content = [];

            $search = $request['search'];
            $value = $search['value'];

            $workingHour = new WorkingHour();
            $model = EmpBasic::query();

            if ($value != '') {
                $model->with('attendDaily')->where('EmpID', 'LIKE', "%$value%");;
            }
            if ($request['order'][0]['column'] != 0) {
                $columnName = $request['columns'][$request['order'][0]['column']]['data'];
                $model->orderBy($columnName, $request['order'][0]['dir']);
            } else {
                $model->orderBy('id', 'DESC');
            }

            $model->offset($request['start'])->limit($request['length']);

            /** @var EmpBasic $employee */
            foreach ($model->get() as $employee) {
                /** @var AttendDaily $attendDaily */
                foreach ($employee->attendDaily as $attendDaily) {
                    $normalHour = $workingHour->getNormalHour($attendDaily->getInTime1(), $attendDaily->getOutTime2());
                    $content[] = [
                        'emp_id' => $employee->getEmployeeID(),
                        'last_name_2_c' => $employee->getFullName(),
                        'date' => $attendDaily?->getDate()->format('Y-m-d'),
                        'normal_hours' => $normalHour['hour'] . ' Hour(s) ' . $normalHour['minute'] . ' Minute(s)',
                        'ot_hours' => $workingHour->getOvertimeHour($attendDaily->getOutTime2()) . ' Hour(s)',
                    ];
                }
            }

            $countModel = $model->count();

            // Prepare response data
            $responseData = [
                'draw' => $request['draw'], // Cast draw to integer
                'recordsTotal' => $countModel,
                'recordsFiltered' => $countModel,
                'data' => $content,
            ];

            // Return the response as JSON
            $response->getBody()->write(json_encode($responseData));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (Throwable $e) {
            // Handle exception
            $errorResponse = [
                'error' => 'An error occurred: ' . $e->getMessage(),
            ];

            // Return error as JSON response
            $response->getBody()->write(json_encode($errorResponse));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(500); // Set status to 500 (Internal Server Error)
        }

    }

}
