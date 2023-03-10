<?php
/**
 * Course Loop Start
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$course_archive_arg = isset($GLOBALS['tutor_course_archive_arg']) ? $GLOBALS['tutor_course_archive_arg']['column_per_row'] : null;
$columns = $course_archive_arg === null ? tutor_utils()->get_option( 'courses_col_per_row', 3 ) : $course_archive_arg;

?>
<div class="row">