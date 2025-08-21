<?php

class Temp {
	
	public static function content_login () {
		return file_get_contents (dirname (__FILE__) . "/content_login.jazc");
	}
	
	public static function content_home ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_home.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_about ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_about.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_category ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_category.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_course ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_course.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_coursed ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_coursed.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_paid ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_paid.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_paids ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_paids.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_person ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_person.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_persond ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_persond.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_tab1 ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_tab1.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_tab2 ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_tab2.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_tab3 ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_tab3.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_tab4 ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_tab4.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_tab5 ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_tab5.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
	
	public static function content_user ($user) {
		$content = file_get_contents (dirname (__FILE__) . "/content_user.jazc");
		return str_ireplace (array ("%ADMIN%"), array (strtoupper ($user)), $content);
	}
			
	public static function form_category () {
		return file_get_contents (dirname (__FILE__) . "/form_category.jazc");
	}
			
	public static function form_showsub () {
		return file_get_contents (dirname (__FILE__) . "/form_showsub.jazc");
	}
			
	public static function form_sub () {
		return file_get_contents (dirname (__FILE__) . "/form_sub.jazc");
	}
			
	public static function form_course () {
		return file_get_contents (dirname (__FILE__) . "/form_course.jazc");
	}
				
	public static function form_logo () {
		return file_get_contents (dirname (__FILE__) . "/form_logo.jazc");
	}
			
	public static function form_banner () {
		return file_get_contents (dirname (__FILE__) . "/form_banner.jazc");
	}
			
	public static function form_short () {
		return file_get_contents (dirname (__FILE__) . "/form_short.jazc");
	}
			
	public static function form_institutions () {
		return file_get_contents (dirname (__FILE__) . "/form_institutions.jazc");
	}
			
	public static function form_url () {
		return file_get_contents (dirname (__FILE__) . "/form_url.jazc");
	}
			
	public static function form_showlesson () {
		return file_get_contents (dirname (__FILE__) . "/form_showlesson.jazc");
	}
			
	public static function form_lesson () {
		return file_get_contents (dirname (__FILE__) . "/form_lesson.jazc");
	}
				
	public static function form_title () {
		return file_get_contents (dirname (__FILE__) . "/form_title.jazc");
	}
			
	public static function form_text () {
		return file_get_contents (dirname (__FILE__) . "/form_text.jazc");
	}
			
	public static function form_imgt () {
		return file_get_contents (dirname (__FILE__) . "/form_imgt.jazc");
	}
			
	public static function form_titlea () {
		return file_get_contents (dirname (__FILE__) . "/form_titlea.jazc");
	}
			
	public static function form_texta () {
		return file_get_contents (dirname (__FILE__) . "/form_texta.jazc");
	}
			
	public static function form_imga () {
		return file_get_contents (dirname (__FILE__) . "/form_imga.jazc");
	}
	
	public static function form_titleg () {
		return file_get_contents (dirname (__FILE__) . "/form_titleg.jazc");
	}
			
	public static function form_imgg () {
		return file_get_contents (dirname (__FILE__) . "/form_imgg.jazc");
	}
			
	public static function form_ambience () {
		return file_get_contents (dirname (__FILE__) . "/form_ambience.jazc");
	}
			
	public static function form_contact () {
		return file_get_contents (dirname (__FILE__) . "/form_contact.jazc");
	}
		
	public static function form_about () {
		return file_get_contents (dirname (__FILE__) . "/form_about.jazc");
	}
		
	public static function form_home () {
		return file_get_contents (dirname (__FILE__) . "/form_home.jazc");
	}
		
	public static function form_certification () {
		return file_get_contents (dirname (__FILE__) . "/form_certification.jazc");
	}
		
	public static function form_location () {
		return file_get_contents (dirname (__FILE__) . "/form_location.jazc");
	}
				
	public static function form_user () {
		return file_get_contents (dirname (__FILE__) . "/form_user.jazc");
	}
	
}


?>