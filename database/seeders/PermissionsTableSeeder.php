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
                'title' => 'hackthon_access',
            ],
            [
                'id'    => 181,
                'title' => 'hackathon_form_option_access',
            ],
            [
                'id'    => 182,
                'title' => 'challenge_create',
            ],
            [
                'id'    => 183,
                'title' => 'challenge_edit',
            ],
            [
                'id'    => 184,
                'title' => 'challenge_show',
            ],
            [
                'id'    => 185,
                'title' => 'challenge_delete',
            ],
            [
                'id'    => 186,
                'title' => 'challenge_access',
            ],
            [
                'id'    => 187,
                'title' => 'actual_solution_create',
            ],
            [
                'id'    => 188,
                'title' => 'actual_solution_edit',
            ],
            [
                'id'    => 189,
                'title' => 'actual_solution_show',
            ],
            [
                'id'    => 190,
                'title' => 'actual_solution_delete',
            ],
            [
                'id'    => 191,
                'title' => 'actual_solution_access',
            ],
            [
                'id'    => 192,
                'title' => 'mentorship_needed_create',
            ],
            [
                'id'    => 193,
                'title' => 'mentorship_needed_edit',
            ],
            [
                'id'    => 194,
                'title' => 'mentorship_needed_show',
            ],
            [
                'id'    => 195,
                'title' => 'mentorship_needed_delete',
            ],
            [
                'id'    => 196,
                'title' => 'mentorship_needed_access',
            ],
            [
                'id'    => 197,
                'title' => 'participation_method_create',
            ],
            [
                'id'    => 198,
                'title' => 'participation_method_edit',
            ],
            [
                'id'    => 199,
                'title' => 'participation_method_show',
            ],
            [
                'id'    => 200,
                'title' => 'participation_method_delete',
            ],
            [
                'id'    => 201,
                'title' => 'participation_method_access',
            ],
            [
                'id'    => 202,
                'title' => 'member_role_create',
            ],
            [
                'id'    => 203,
                'title' => 'member_role_edit',
            ],
            [
                'id'    => 204,
                'title' => 'member_role_show',
            ],
            [
                'id'    => 205,
                'title' => 'member_role_delete',
            ],
            [
                'id'    => 206,
                'title' => 'member_role_access',
            ],
            [
                'id'    => 207,
                'title' => 'study_levelss_create',
            ],
            [
                'id'    => 208,
                'title' => 'study_levelss_edit',
            ],
            [
                'id'    => 209,
                'title' => 'study_levelss_show',
            ],
            [
                'id'    => 210,
                'title' => 'study_levelss_delete',
            ],
            [
                'id'    => 211,
                'title' => 'study_levelss_access',
            ],
            [
                'id'    => 212,
                'title' => 'major_create',
            ],
            [
                'id'    => 213,
                'title' => 'major_edit',
            ],
            [
                'id'    => 214,
                'title' => 'major_show',
            ],
            [
                'id'    => 215,
                'title' => 'major_delete',
            ],
            [
                'id'    => 216,
                'title' => 'major_access',
            ],
            [
                'id'    => 217,
                'title' => 'tshirt_size_create',
            ],
            [
                'id'    => 218,
                'title' => 'tshirt_size_edit',
            ],
            [
                'id'    => 219,
                'title' => 'tshirt_size_show',
            ],
            [
                'id'    => 220,
                'title' => 'tshirt_size_delete',
            ],
            [
                'id'    => 221,
                'title' => 'tshirt_size_access',
            ],
            [
                'id'    => 222,
                'title' => 'team_management_access',
            ],
            [
                'id'    => 223,
                'title' => 'member_management_access',
            ],
            [
                'id'    => 224,
                'title' => 'challenge_management_access',
            ],
            [
                'id'    => 225,
                'title' => 'evaluation_system_access',
            ],
            [
                'id'    => 226,
                'title' => 'event_management_access',
            ],
            [
                'id'    => 227,
                'title' => 'skills_and_achievement_access',
            ],
            [
                'id'    => 228,
                'title' => 'team_create',
            ],
            [
                'id'    => 229,
                'title' => 'team_edit',
            ],
            [
                'id'    => 230,
                'title' => 'team_show',
            ],
            [
                'id'    => 231,
                'title' => 'team_delete',
            ],
            [
                'id'    => 232,
                'title' => 'team_access',
            ],
            [
                'id'    => 233,
                'title' => 'team_skill_create',
            ],
            [
                'id'    => 234,
                'title' => 'team_skill_edit',
            ],
            [
                'id'    => 235,
                'title' => 'team_skill_show',
            ],
            [
                'id'    => 236,
                'title' => 'team_skill_delete',
            ],
            [
                'id'    => 237,
                'title' => 'team_skill_access',
            ],
            [
                'id'    => 238,
                'title' => 'team_achievement_create',
            ],
            [
                'id'    => 239,
                'title' => 'team_achievement_edit',
            ],
            [
                'id'    => 240,
                'title' => 'team_achievement_show',
            ],
            [
                'id'    => 241,
                'title' => 'team_achievement_delete',
            ],
            [
                'id'    => 242,
                'title' => 'team_achievement_access',
            ],
            [
                'id'    => 243,
                'title' => 'member_create',
            ],
            [
                'id'    => 244,
                'title' => 'member_edit',
            ],
            [
                'id'    => 245,
                'title' => 'member_show',
            ],
            [
                'id'    => 246,
                'title' => 'member_delete',
            ],
            [
                'id'    => 247,
                'title' => 'member_access',
            ],
            [
                'id'    => 248,
                'title' => 'member_checkpoint_create',
            ],
            [
                'id'    => 249,
                'title' => 'member_checkpoint_edit',
            ],
            [
                'id'    => 250,
                'title' => 'member_checkpoint_show',
            ],
            [
                'id'    => 251,
                'title' => 'member_checkpoint_delete',
            ],
            [
                'id'    => 252,
                'title' => 'member_checkpoint_access',
            ],
            [
                'id'    => 253,
                'title' => 'hackathon_qr_code_create',
            ],
            [
                'id'    => 254,
                'title' => 'hackathon_qr_code_edit',
            ],
            [
                'id'    => 255,
                'title' => 'hackathon_qr_code_show',
            ],
            [
                'id'    => 256,
                'title' => 'hackathon_qr_code_delete',
            ],
            [
                'id'    => 257,
                'title' => 'hackathon_qr_code_access',
            ],
            [
                'id'    => 258,
                'title' => 'challenge_category_create',
            ],
            [
                'id'    => 259,
                'title' => 'challenge_category_edit',
            ],
            [
                'id'    => 260,
                'title' => 'challenge_category_show',
            ],
            [
                'id'    => 261,
                'title' => 'challenge_category_delete',
            ],
            [
                'id'    => 262,
                'title' => 'challenge_category_access',
            ],
            [
                'id'    => 263,
                'title' => 'h_event_management_create',
            ],
            [
                'id'    => 264,
                'title' => 'h_event_management_edit',
            ],
            [
                'id'    => 265,
                'title' => 'h_event_management_show',
            ],
            [
                'id'    => 266,
                'title' => 'h_event_management_delete',
            ],
            [
                'id'    => 267,
                'title' => 'h_event_management_access',
            ],
            [
                'id'    => 268,
                'title' => 'event_create',
            ],
            [
                'id'    => 269,
                'title' => 'event_edit',
            ],
            [
                'id'    => 270,
                'title' => 'event_show',
            ],
            [
                'id'    => 271,
                'title' => 'event_delete',
            ],
            [
                'id'    => 272,
                'title' => 'event_access',
            ],
            [
                'id'    => 273,
                'title' => 'checkpoint_create',
            ],
            [
                'id'    => 274,
                'title' => 'checkpoint_edit',
            ],
            [
                'id'    => 275,
                'title' => 'checkpoint_show',
            ],
            [
                'id'    => 276,
                'title' => 'checkpoint_delete',
            ],
            [
                'id'    => 277,
                'title' => 'checkpoint_access',
            ],
            [
                'id'    => 278,
                'title' => 'checkpoint_type_create',
            ],
            [
                'id'    => 279,
                'title' => 'checkpoint_type_edit',
            ],
            [
                'id'    => 280,
                'title' => 'checkpoint_type_show',
            ],
            [
                'id'    => 281,
                'title' => 'checkpoint_type_delete',
            ],
            [
                'id'    => 282,
                'title' => 'checkpoint_type_access',
            ],
            [
                'id'    => 283,
                'title' => 'evaluation_create',
            ],
            [
                'id'    => 284,
                'title' => 'evaluation_edit',
            ],
            [
                'id'    => 285,
                'title' => 'evaluation_show',
            ],
            [
                'id'    => 286,
                'title' => 'evaluation_delete',
            ],
            [
                'id'    => 287,
                'title' => 'evaluation_access',
            ],
            [
                'id'    => 288,
                'title' => 'evaluation_criterion_create',
            ],
            [
                'id'    => 289,
                'title' => 'evaluation_criterion_edit',
            ],
            [
                'id'    => 290,
                'title' => 'evaluation_criterion_show',
            ],
            [
                'id'    => 291,
                'title' => 'evaluation_criterion_delete',
            ],
            [
                'id'    => 292,
                'title' => 'evaluation_criterion_access',
            ],
            [
                'id'    => 293,
                'title' => 'judge_create',
            ],
            [
                'id'    => 294,
                'title' => 'judge_edit',
            ],
            [
                'id'    => 295,
                'title' => 'judge_show',
            ],
            [
                'id'    => 296,
                'title' => 'judge_delete',
            ],
            [
                'id'    => 297,
                'title' => 'judge_access',
            ],
            [
                'id'    => 298,
                'title' => 'skill_create',
            ],
            [
                'id'    => 299,
                'title' => 'skill_edit',
            ],
            [
                'id'    => 300,
                'title' => 'skill_show',
            ],
            [
                'id'    => 301,
                'title' => 'skill_delete',
            ],
            [
                'id'    => 302,
                'title' => 'skill_access',
            ],
            [
                'id'    => 303,
                'title' => 'achievement_create',
            ],
            [
                'id'    => 304,
                'title' => 'achievement_edit',
            ],
            [
                'id'    => 305,
                'title' => 'achievement_show',
            ],
            [
                'id'    => 306,
                'title' => 'achievement_delete',
            ],
            [
                'id'    => 307,
                'title' => 'achievement_access',
            ],
            [
                'id'    => 308,
                'title' => 'transportation_create',
            ],
            [
                'id'    => 309,
                'title' => 'transportation_edit',
            ],
            [
                'id'    => 310,
                'title' => 'transportation_show',
            ],
            [
                'id'    => 311,
                'title' => 'transportation_delete',
            ],
            [
                'id'    => 312,
                'title' => 'transportation_access',
            ],
            [
                'id'    => 313,
                'title' => 'difficulty_level_create',
            ],
            [
                'id'    => 314,
                'title' => 'difficulty_level_edit',
            ],
            [
                'id'    => 315,
                'title' => 'difficulty_level_show',
            ],
            [
                'id'    => 316,
                'title' => 'difficulty_level_delete',
            ],
            [
                'id'    => 317,
                'title' => 'difficulty_level_access',
            ],
            [
                'id'    => 318,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 319,
                'title' => 'user_challenge_create',
            ],
            [
                'id'    => 320,
                'title' => 'user_challenge_edit',
            ],
            [
                'id'    => 321,
                'title' => 'user_challenge_show',
            ],
            [
                'id'    => 322,
                'title' => 'user_challenge_delete',
            ],
            [
                'id'    => 323,
                'title' => 'user_challenge_access',
            ],
            [
                'id'    => 324,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
