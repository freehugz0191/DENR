<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use DB;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'dept_desc' => 'Planning and Support Unit(PSU)'
        ],
        [
            'dept_desc' => 'Conservation Unit (CU)'
        ],
        [
            'dept_desc' => 'Development Unit (DU)'
        ],
        [
            'dept_desc' => 'Patents and Deeds Unit (PDU)'
        ],
        [
            'dept_desc' => 'Licenses and Permits Unit (LPU)'
        ],
        [
            'dept_desc' => 'Survey Unit (SU)'
        ],
        [
            'dept_desc' => 'Compliance Monitoring and Investigation Unit (CMIU)'
        ],
        [
            'dept_desc' => 'Surveillance and Intelligence Unit (SIU)'
        ]
        );

        DB::table('docdesc')->insert([
            'doc_desc' => 'Letter of intent from the People’s Organization (PO) to enter into an eNGP'
        ],
        [
            'doc_desc' => 'PO resolution supporting the implementation of eNGP'
        ],
        [
            'doc_desc' => 'Copy of purchase order'
        ],
        [
            'doc_desc' => 'PENRO Approval Letter'
        ]
        );

        DB::table('docstatus')->insert([
            'status_desc' => 'Pending'
        ],
        [
            'status_desc' => 'received by Planning and Support Unit (PSU)'
        ],
        [
            'status_desc' => 'received by Conservation Unit (CU)'
        ],
        );

        DB::table('dynamic_payments')->insert([
            'tran_id' => '1',
            'payment_desc' => 'transportation',
            'amount' => '200'
        ],
        [
            'tran_id' => '1',
            'payment_desc' => 'intensity',
            'amount' => '115'
        ],
        [
            'tran_id' => '1',
            'payment_desc' => 'paper',
            'amount' => '15'
        ],
        [
            'tran_id' => '2',
            'payment_desc' => 'transportation',
            'amount' => '200'
        ]
        );

        DB::table('procedure_sections')->insert([
            'section_desc' => 'Conservation and Development Section (CDS)'
        ],
        [
            'section_desc' => 'Enforcement and Monitoring Section (EMS)'
        ],
        [
            'section_desc' => 'Regulation and Permitting Section (RPS)'
        ]
        );

        DB::table('received_docs')->insert([
            'doc_id' => '1',
            'tran_id' => '1',
            'status' => '2',
            'dept_id' => '2',
            'user_id' => '2',
            'file' => '1612685567.pdf',
            'remarks' => 'sample document',
            'sender' => '2',
        ]);

        DB::table('released_docs')->insert([
            'doc_desc' => 'Permit To Operate',
            'file' => '1612586565.pdf'
        ],
        [
            'doc_desc' => 'Chainsaw Permit',
            'file' => '1612439427.pdf'
        ],
        );

        DB::table('request_rel_docs')->insert([
            'reldoc_id' => '2',
            'tran_id' => '6',
            'status_id' => '2',
            'requser_id' => '1',
            'remarks' => 'sample',
        ],
        [
            'reldoc_id' => '1',
            'tran_id' => '3',
            'status_id' => '2',
            'requser_id' => '1',
            'remarks' => 'sample remarks',
        ]
        );

        DB::table('status')->insert([
            'status_name' => 'Pending'
        ],
        [
            'status_name' => 'Approved'
        ],
        [
            'status_name' => 'Rejected'
        ]
        );

        DB::table('trandesc')->insert([
            'tran_desc' => 'Permit to import Chainsaw',
            'section_id' => '3',
            'file' => '1612263681.pdf',
        ],
        [
            'tran_desc' => 'Issuance of Certificate of Tree Plantation Ownership',
            'section_id' => '3',
            'file' => '1612264105.pdf',
        ],
        [
            'tran_desc' => 'Temporary Release of Conveyance',
            'section_id' => '2',
            'file' => '1612308917.pdf',
        ],
        [
            'tran_desc' => 'Issuance of CBFMA final',
            'section_id' => '1',
            'file' => '1612363841.pdf',
        ],
        [
            'tran_desc' => 'Issuance of FLAgT',
            'section_id' => '1',
            'file' => '1612363915.pdf',
        ],
        );

        DB::table('transactions')->insert([
            'procedure_id' => '1',
            'applicant_id' => '1',
            'address' => 'Villa Felisa Subd., Panabo City',
            'latitude' => '7.30734095',
            'longitude' => '125.685224',
            'status_ID' => '1',
            'remarks' => 'sample remarks',
        ],
        [
            'procedure_id' => '2',
            'applicant_id' => '2',
            'address' => 'Villa Felisa Subd., Panabo City',
            'latitude' => '7.30755379',
            'longitude' => '125.684757',
            'status_ID' => '1',
            'remarks' => 'sample remarks',
        ],
        [
            'procedure_id' => '3',
            'applicant_id' => '3',
            'address' => 'Villa Felisa Subd., Panabo City',
            'latitude' => '7.30053554',
            'longitude' => '125.674409',
            'status_ID' => '1',
            'remarks' => 'sample',
        ]
        );

        DB::table('tran_histories')->insert([
            'tran_id' => '2',
            'user_id' => '2',
            'tran_remarks' => 'sample remarks',
        ]);

    }
}
