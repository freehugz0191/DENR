<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentReq;
use App\Models\Applicant;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointment = AppointmentReq::join('applicants', 'applicants.id', 'appointment_reqs.applicant_id')
                                    ->select('appointment_reqs.*', 'applicants.lname', 'applicants.fname')
                                    ->where('appointment_reqs.status', '=', 2)
                                    ->get();
        $applicant = Applicant::all();
        return view('appointments', compact('appointment'))
                ->with('applicant', $applicant);
    }



    public function store(Request $request)
    {
        AppointmentReq::create($request->all());
        return redirect('/appointments');
    }

    public function edit($id)
    {
        $appointment = AppointmentReq::findOrFail($id);
        $applicant = Applicant::all();


        return view('/editAppointment')
        ->with('applicant', $applicant)
        ->with('appointment', $appointment);
    }

    public function update(Request $request, $id)
    {
        AppointmentReq::where('id', '=', $id)->update(array(
            'appointment_date' => $request->input('appointment_date'),
            'applicant_id' => $request->input('applicant_id'),
            'description' => $request->input('description')
            ));


        $applicant = Applicant::all();

        return redirect('/appointments')
        ->with('applicant', $applicant);
    }

    public function approveAppointment(Request $request)
    {
        AppointmentReq::where('id', '=', $request->input('appid'))->update(array(
            'appointment_date' => $request->input('appointment_date'),
            'status'           => 2
        ));

        return redirect('/appointments');
    }

    public function showPendingAppointments()
    {
        $appointment = AppointmentReq::join('applicants', 'applicants.id', 'appointment_reqs.applicant_id')
                    ->select('appointment_reqs.*', 'applicants.lname', 'applicants.fname')
                    ->where('appointment_reqs.status', '=', 1)
                    ->paginate(10);
        
        return view('pendingAppointments', compact('appointment'));
    }
}
