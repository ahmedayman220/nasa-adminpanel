<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'bootcamp_access',
            ],
            [
                'id'    => 18,
                'title' => 'handel_option_access',
            ],
            [
                'id'    => 19,
                'title' => 'participant_access',
            ],
            [
                'id'    => 20,
                'title' => 'bootcamp_management_access',
            ],
            [
                'id'    => 21,
                'title' => 'workshops_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'education_level_create',
            ],
            [
                'id'    => 23,
                'title' => 'education_level_edit',
            ],
            [
                'id'    => 24,
                'title' => 'education_level_show',
            ],
            [
                'id'    => 25,
                'title' => 'education_level_delete',
            ],
            [
                'id'    => 26,
                'title' => 'education_level_access',
            ],
            [
                'id'    => 27,
                'title' => 'mention_your_field_create',
            ],
            [
                'id'    => 28,
                'title' => 'mention_your_field_edit',
            ],
            [
                'id'    => 29,
                'title' => 'mention_your_field_show',
            ],
            [
                'id'    => 30,
                'title' => 'mention_your_field_delete',
            ],
            [
                'id'    => 31,
                'title' => 'mention_your_field_access',
            ],
            [
                'id'    => 32,
                'title' => 'bootcamp_form_description_create',
            ],
            [
                'id'    => 33,
                'title' => 'bootcamp_form_description_edit',
            ],
            [
                'id'    => 34,
                'title' => 'bootcamp_form_description_show',
            ],
            [
                'id'    => 35,
                'title' => 'bootcamp_form_description_delete',
            ],
            [
                'id'    => 36,
                'title' => 'bootcamp_form_description_access',
            ],
            [
                'id'    => 37,
                'title' => 'study_level_create',
            ],
            [
                'id'    => 38,
                'title' => 'study_level_edit',
            ],
            [
                'id'    => 39,
                'title' => 'study_level_show',
            ],
            [
                'id'    => 40,
                'title' => 'study_level_delete',
            ],
            [
                'id'    => 41,
                'title' => 'study_level_access',
            ],
            [
                'id'    => 42,
                'title' => 'workshop_create',
            ],
            [
                'id'    => 43,
                'title' => 'workshop_edit',
            ],
            [
                'id'    => 44,
                'title' => 'workshop_show',
            ],
            [
                'id'    => 45,
                'title' => 'workshop_delete',
            ],
            [
                'id'    => 46,
                'title' => 'workshop_access',
            ],
            [
                'id'    => 47,
                'title' => 'workshop_schedule_create',
            ],
            [
                'id'    => 48,
                'title' => 'workshop_schedule_edit',
            ],
            [
                'id'    => 49,
                'title' => 'workshop_schedule_show',
            ],
            [
                'id'    => 50,
                'title' => 'workshop_schedule_delete',
            ],
            [
                'id'    => 51,
                'title' => 'workshop_schedule_access',
            ],
            [
                'id'    => 52,
                'title' => 'bootcamp_participant_create',
            ],
            [
                'id'    => 53,
                'title' => 'bootcamp_participant_edit',
            ],
            [
                'id'    => 54,
                'title' => 'bootcamp_participant_show',
            ],
            [
                'id'    => 55,
                'title' => 'bootcamp_participant_delete',
            ],
            [
                'id'    => 56,
                'title' => 'bootcamp_participant_access',
            ],
            [
                'id'    => 57,
                'title' => 'participant_workshop_assignment_create',
            ],
            [
                'id'    => 58,
                'title' => 'participant_workshop_assignment_edit',
            ],
            [
                'id'    => 59,
                'title' => 'participant_workshop_assignment_show',
            ],
            [
                'id'    => 60,
                'title' => 'participant_workshop_assignment_delete',
            ],
            [
                'id'    => 61,
                'title' => 'participant_workshop_assignment_access',
            ],
            [
                'id'    => 62,
                'title' => 'participant_workshop_preference_create',
            ],
            [
                'id'    => 63,
                'title' => 'participant_workshop_preference_edit',
            ],
            [
                'id'    => 64,
                'title' => 'participant_workshop_preference_show',
            ],
            [
                'id'    => 65,
                'title' => 'participant_workshop_preference_delete',
            ],
            [
                'id'    => 66,
                'title' => 'participant_workshop_preference_access',
            ],
            [
                'id'    => 67,
                'title' => 'bootcamp_detail_create',
            ],
            [
                'id'    => 68,
                'title' => 'bootcamp_detail_edit',
            ],
            [
                'id'    => 69,
                'title' => 'bootcamp_detail_show',
            ],
            [
                'id'    => 70,
                'title' => 'bootcamp_detail_delete',
            ],
            [
                'id'    => 71,
                'title' => 'bootcamp_detail_access',
            ],
            [
                'id'    => 72,
                'title' => 'bootcamp_attendee_create',
            ],
            [
                'id'    => 73,
                'title' => 'bootcamp_attendee_edit',
            ],
            [
                'id'    => 74,
                'title' => 'bootcamp_attendee_show',
            ],
            [
                'id'    => 75,
                'title' => 'bootcamp_attendee_delete',
            ],
            [
                'id'    => 76,
                'title' => 'bootcamp_attendee_access',
            ],
            [
                'id'    => 77,
                'title' => 'time_management_access',
            ],
            [
                'id'    => 78,
                'title' => 'time_work_type_create',
            ],
            [
                'id'    => 79,
                'title' => 'time_work_type_edit',
            ],
            [
                'id'    => 80,
                'title' => 'time_work_type_show',
            ],
            [
                'id'    => 81,
                'title' => 'time_work_type_delete',
            ],
            [
                'id'    => 82,
                'title' => 'time_work_type_access',
            ],
            [
                'id'    => 83,
                'title' => 'time_project_create',
            ],
            [
                'id'    => 84,
                'title' => 'time_project_edit',
            ],
            [
                'id'    => 85,
                'title' => 'time_project_show',
            ],
            [
                'id'    => 86,
                'title' => 'time_project_delete',
            ],
            [
                'id'    => 87,
                'title' => 'time_project_access',
            ],
            [
                'id'    => 88,
                'title' => 'time_entry_create',
            ],
            [
                'id'    => 89,
                'title' => 'time_entry_edit',
            ],
            [
                'id'    => 90,
                'title' => 'time_entry_show',
            ],
            [
                'id'    => 91,
                'title' => 'time_entry_delete',
            ],
            [
                'id'    => 92,
                'title' => 'time_entry_access',
            ],
            [
                'id'    => 93,
                'title' => 'time_report_create',
            ],
            [
                'id'    => 94,
                'title' => 'time_report_edit',
            ],
            [
                'id'    => 95,
                'title' => 'time_report_show',
            ],
            [
                'id'    => 96,
                'title' => 'time_report_delete',
            ],
            [
                'id'    => 97,
                'title' => 'time_report_access',
            ],
            [
                'id'    => 98,
                'title' => 'contact_management_access',
            ],
            [
                'id'    => 99,
                'title' => 'contact_company_create',
            ],
            [
                'id'    => 100,
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => 101,
                'title' => 'contact_company_show',
            ],
            [
                'id'    => 102,
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => 103,
                'title' => 'contact_company_access',
            ],
            [
                'id'    => 104,
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => 105,
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => 106,
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => 107,
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => 108,
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => 109,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 110,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 111,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 112,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 113,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 114,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 115,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 116,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 117,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 118,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 119,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 120,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 121,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 122,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 123,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 124,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 125,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 126,
                'title' => 'task_create',
            ],
            [
                'id'    => 127,
                'title' => 'task_edit',
            ],
            [
                'id'    => 128,
                'title' => 'task_show',
            ],
            [
                'id'    => 129,
                'title' => 'task_delete',
            ],
            [
                'id'    => 130,
                'title' => 'task_access',
            ],
            [
                'id'    => 131,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 132,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 133,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 134,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 135,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 136,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 137,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 138,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 139,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 140,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 141,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 142,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 143,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 144,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 145,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 146,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 147,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 148,
                'title' => 'asset_create',
            ],
            [
                'id'    => 149,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 150,
                'title' => 'asset_show',
            ],
            [
                'id'    => 151,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 152,
                'title' => 'asset_access',
            ],
            [
                'id'    => 153,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 154,
                'title' => 'chatbot_access',
            ],
            [
                'id'    => 155,
                'title' => 'chatbot_reply_create',
            ],
            [
                'id'    => 156,
                'title' => 'chatbot_reply_edit',
            ],
            [
                'id'    => 157,
                'title' => 'chatbot_reply_show',
            ],
            [
                'id'    => 158,
                'title' => 'chatbot_reply_delete',
            ],
            [
                'id'    => 159,
                'title' => 'chatbot_reply_access',
            ],
            [
                'id'    => 160,
                'title' => 'chatbot_traning_data_create',
            ],
            [
                'id'    => 161,
                'title' => 'chatbot_traning_data_edit',
            ],
            [
                'id'    => 162,
                'title' => 'chatbot_traning_data_show',
            ],
            [
                'id'    => 163,
                'title' => 'chatbot_traning_data_delete',
            ],
            [
                'id'    => 164,
                'title' => 'chatbot_traning_data_access',
            ],
            [
                'id'    => 165,
                'title' => 'qr_code_create',
            ],
            [
                'id'    => 166,
                'title' => 'qr_code_edit',
            ],
            [
                'id'    => 167,
                'title' => 'qr_code_show',
            ],
            [
                'id'    => 168,
                'title' => 'qr_code_delete',
            ],
            [
                'id'    => 169,
                'title' => 'qr_code_access',
            ],
            [
                'id'    => 170,
                'title' => 'email_create',
            ],
            [
                'id'    => 171,
                'title' => 'email_edit',
            ],
            [
                'id'    => 172,
                'title' => 'email_show',
            ],
            [
                'id'    => 173,
                'title' => 'email_delete',
            ],
            [
                'id'    => 174,
                'title' => 'email_access',
            ],
            [
                'id'    => 175,
                'title' => 'bootcamp_confirmation_create',
            ],
            [
                'id'    => 176,
                'title' => 'bootcamp_confirmation_edit',
            ],
            [
                'id'    => 177,
                'title' => 'bootcamp_confirmation_show',
            ],
            [
                'id'    => 178,
                'title' => 'bootcamp_confirmation_delete',
            ],
            [
                'id'    => 179,
                'title' => 'bootcamp_confirmation_access',
            ],
            [
                'id'    => 180,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
