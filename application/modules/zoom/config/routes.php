<?php defined('BASEPATH') OR exit('No direct script access allowed');


require_once( BASEPATH . 'database/DB' . EXT );
$db = & DB();
$db->select('a.id, a.log_id, a.name, a.shortname');
$db->from('loginfo_tbl a');
$db->where('a.user_types', 1);
$db->or_where('a.user_types', 2);
$query = $db->get();
$result = $query->result();


foreach ($result as $row) {
    //=======zoom module ============
    $route[$row->shortname . '/zoom-meeting'] = 'zoom/zoomcontroler/index';
    $route[$row->shortname . '/zoom-meeting/(:any)'] = 'zoom/zoomcontroler/index/$1';
    $route[$row->shortname . '/meeting-save'] = 'zoom/zoomcontroler/meeting_save';
    $route[$row->shortname . '/meeting-edit'] = 'zoom/zoomcontroler/meeting_edit';
    $route[$row->shortname . '/meeting-update'] = 'zoom/zoomcontroler/meeting_update';
    $route[$row->shortname . '/meeting-delete'] = 'zoom/zoomcontroler/meeting_delete';
    $route[$row->shortname . '/join-zoom-meeting'] = 'zoom/zoomcontroler/join_zoom_meeting';
    $route[$row->shortname . '/join-zoom-meeting/(:any)'] = 'zoom/zoomcontroler/join_zoom_meeting/$1';
    $route[$row->shortname . '/zoom-config'] = 'zoom/zoomcontroler/zoom_config';
    $route[$row->shortname . '/zoom-config-save'] = 'zoom/zoomcontroler/zoom_config_save';
    $route[$row->shortname . '/add-live-course'] = 'zoom/zoomcontroler/add_live_course';
    $route[$row->shortname . '/live-course-save'] = 'zoom/zoomcontroler/live_course_save';
    $route[$row->shortname . '/live-course-list'] = 'zoom/zoomcontroler/live_course_list';
    $route[$row->shortname . '/livecourse-datalist'] = 'zoom/zoomcontroler/livecourse_datalist';
    $route[$row->shortname . '/live-course-edit/(:any)'] = 'zoom/zoomcontroler/live_course_edit/$1';
    $route[$row->shortname . '/live-course-update'] = 'zoom/zoomcontroler/live_course_update';
    $route[$row->shortname . '/live-course-delete'] = 'zoom/zoomcontroler/live_course_delete';


    
    $route[$row->shortname . '/add-event'] = 'zoom/zoomcontroler/add_event';
    $route[$row->shortname . '/live-event-save'] = 'zoom/zoomcontroler/live_event_save';
    $route[$row->shortname . '/event-list'] = 'zoom/zoomcontroler/event_list';
    $route[$row->shortname . '/event-inactive'] = 'zoom/zoomcontroler/event_inactive';
    $route[$row->shortname . '/event-active'] = 'zoom/zoomcontroler/event_active';
    $route[$row->shortname . '/liveevent-datalist'] = 'zoom/zoomcontroler/liveevent_datalist';
    $route[$row->shortname . '/live-event-edit/(:any)'] = 'zoom/zoomcontroler/live_event_edit/$1';
    $route[$row->shortname . '/live-event-update'] = 'zoom/zoomcontroler/live_event_update';
    $route[$row->shortname . '/live-event-delete'] = 'zoom/zoomcontroler/live_event_delete';

    
    $route[$row->shortname . '/event-details/(:any)'] = 'zoom/zoomcontroler/event_details/$1';

}