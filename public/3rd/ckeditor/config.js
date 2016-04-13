/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.toolbar = 'MyToolbar';
    config.toolbar_MyToolbar =
    [
    	['Source','Bold', 'Italic', '-', 'NumberedList', 'BulletedList','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'Link', 'Unlink','-','About']
    ];
    config.extraPlugins='onchange';
    config.minimumChangeMilliseconds = 500;
};
