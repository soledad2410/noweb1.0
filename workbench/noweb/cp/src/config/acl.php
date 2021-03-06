    <?php
/**
 * Created by syhung.
 * nonweb system version 1.0
 * Date: 11/25/14
 * Time: 10:39 AM
 * Use to set user privileges
 * allow : any,none or specify group, default left blank to get from database
 */
return [
	'modules' => [
		/** Control panel modules */
		'noweb\cp\indexcontroller' => [
			'title' => 'Index module of control panel',
			'dashboard' => [
				'title' => 'Cp dashboard',
				'allows' => 'any',
			],
			'ajaxlogout' => [
				'title' => 'Logout account',
				'allows' => 'any',
			],
		],

		/** Contact controller */
		'noweb\cp\contactcontroller' => [
			'title' => 'Quản lý các liên hệ của khách hàng',
			'index' => [
				'title' => 'Danh sách các liên hệ',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Xóa liên hệ',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Lấy thông tin liên hệ',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Sửa thông tin liên hệ',
				'allows' => 'any',
			],
			'getnew' => [
				'title' => 'Kiểm tra có liên hệ mới không',
				'allows' => 'any',
			],
		],

		/** Tags Controller */
		'noweb\cp\tagscontroller' => [
			'title' => 'Tags controller of control panel',
			'index' => [
				'title' => 'List tags',
				'allows' => 'any',
			],
			'create' => [
				'title' => 'Add new tag',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Delete tag',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Get tag',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Edit tag',
				'allows' => 'any',
			],
		],

		/** Profile Controller */
		'noweb\cp\profilecontroller' => [
			'title' => 'Profile controller',
			'index' => [
				'title' => 'Index of profile',
				'allows' => 'any',
			],
			'activities' => [
				'title' => 'Logged histories',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Edit profile page',
				'allows' => 'any',
			],
			'postedit' => [
				'title' => 'Edit post info action',
				'allows' => 'any',
			],
		],
		/** News Controller */
		'noweb\cp\newscontroller' => [
			'title' => 'News modules',
			'index' => [
				'title' => 'Index of news module',
				'allows' => 'any',
			],
			'create' => [
				'title' => 'Add new article',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Get a news',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Edit news',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Delete article',
				'allows' => 'any',
			],
			'category' => [
				'title' => 'News category',
				'allows' => 'any',
			],
			'comments' => [
				'title' => 'Comments management',
				'allows' => 'any',
			],
			'editcomment' => [
				'title' => 'Comments management',
				'allows' => 'any',
			],
			'getcomment' => [
				'title' => 'Get comment detail',
				'allows' => 'any',
			],
			'deletecomment' => [
				'title' => 'Delete a comment',
				'allows' => 'any',
			],
			'savecomment' => [
				'title' => 'Save a comment',
				'allows' => 'any',
			],
		],
		/** Caching */
		'noweb\cp\cachingcontroller' => [
			'title' => 'Caching module',
			'visibility' => 'hidden',
			'push' => [
				'title' => 'push cache',
				'allows' => 'any',
			],
			'create' => [
				'title' => 'Add new article',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Get a news',
				'allows' => 'any',
			],
		],
		/** setting */
		'noweb\cp\settingcontroller' => [
			'title' => 'setting module',
			'visibility' => 'hidden',
			'switchlang' => [
				'title' => 'Switch language',
				'allows' => 'any',
			],
		    'index' => [
		        'title' => 'Cấu hình hệ thống',
		        'allows' => 'any',
		    ],
		],
		/** Category Controller */
		'noweb\cp\categorycontroller' => [
			'title' => 'Category modules',
			'index' => [
				'title' => 'Index of  module',
				'allows' => 'any',
			],
			'create' => [
				'title' => 'Add new ',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Get category info',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Edit category info ',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Delete category ',
				'allows' => 'any',
			],
			'saveorder' => [ // strtolower(action);
				'title' => 'Save category position',
				'allows' => 'any',
			],
		],
		/** Admin Controller */
		'noweb\cp\admincontroller' => [
			'title' => 'Admin controller',
			'index' => [
				'title' => 'Index of admin user managements',
				'allows' => 'any',
			],
			'activities' => [
				'title' => 'Logged histories',
				'allows' => '',
			],
			'edit' => [
				'title' => 'Edit profile page',
				'allows' => '',
			],
			'postedit' => [
				'title' => 'Edit post info action',
				'allows' => '',
			],
			'createuser' => [
				'title' => 'Create new user',
				'allows' => 'any',
			],
			'deleteuser' => [
				'title' => 'Delete User',
				'allows' => 'any',
			],
			'edituser' => [
				'title' => 'Edit User',
				'allows' => 'any',
			],
			'group' => [
				'title' => 'Group management',
				'allows' => 'any',
			],
			'deletegroup' => [
				'title' => 'Delete group',
				'allows' => 'any',
			],
			'editgroup' => [
				'title' => 'Edit group',
				'allows' => 'any',
			],
		],

		/** Inventory */
		'noweb\cp\inventorycontroller' => [
			'title' => 'Inventory controller',
			'index' => [
				'title' => 'Trang quản lý hàng hóa kho',
				'allows' => 'any',
			],
			'product' => [
				'title' => 'Cập nhật thông tin chủng loại hàng hóa',
				'allows' => 'any',
			],
			'catalogue' => [
				'title' => 'Thêm mới danh sách hàng hóa',
				'allows' => 'any',
			],
			'import' => [
				'title' => 'Nhập kho sản phẩm',
				'allows' => 'any',
			],
			'editcatalogue' => [
				'title' => 'Sửa danh sách hàng hóa',
				'allows' => 'any',
			],
			'deletecatalogue' => [
				'title' => 'Xóa danh sách hàng hóa',
				'allows' => 'any',
			],
			'getproduct' => [
				'title' => 'Xem thông tin chủng loại sản phẩm kho',
				'allows' => 'any',
			],
		],

		/** Brand */
		'noweb\cp\brandcontroller' => [
			'title' => 'Module thương hiệu sản phẩm',
			'create' => [
				'title' => 'Cập nhật thương hiệu',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Xóa thương hiệu',
				'allows' => 'any',
			],

			'get' => [
				'title' => 'Lấy thông tin thương hiệu sản phẩm',
				'allows' => 'any',
			],
		],
		/** Product */
		'noweb\cp\productcontroller' => [
			'title' => 'Module quản trị sản phẩm',
			'create' => [
				'title' => 'Thêm sản phẩm',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Xóa sản phẩm',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Lấy thông tin sản phẩm',
				'allows' => 'any',
			],
			'index' => [
				'title' => 'Danh sách sản phẩm',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Sửa sản phẩm',
				'allows' => 'any',
			],
			'review' => [
				'title' => 'Đánh giá của sản phẩm',
				'allows' => 'any',
			],
			'getreview' => [
				'title' => 'Lấy thêm thông tin đánh giá của sản phẩm',
				'allows' => 'any',
			],
			'savereview' => [
				'title' => 'Lưu thông tin đánh giá của sản phẩm',
				'allows' => 'any',
			],
			'deletereview' => [
				'title' => 'Xóa đánh giá của sản phẩm',
				'allows' => 'any',
			],
		],
		/** Api  */
		'noweb\cp\apicontroller' => [
			'title' => 'Module api',
			'index' => [
				'title' => 'Tổng quan và điều hướng',
				'allows' => 'any',
			],

		],
		/** Livechat */
		'noweb\cp\livechatcontroller' => [
			'title' => 'Module hỗ trợ khách hàng',
			'index' => [
				'title' => 'Hỗ trợ khách hàng',
				'allows' => 'any',
			],
			'chatroom_join' => [
				'title' => 'Vào phòng chat',
				'allows' => 'any',
			],
			'chatroom_supporterjoin' => [
				'title' => 'Mời nhân viên hỗ trợ vào phòng chat',
				'allows' => 'any',
			],
			'chatroom_gueststatus' => [
				'title' => 'Tình trạng khách trong phòng',
				'allows' => 'any',
			],
			'chatroom_guestexit' => [
				'title' => 'Khách thoát khỏi phòng',
				'allows' => 'any',
			],

			'widget_status' => [
				'title' => 'Kiểm tra khách mới trong phòng',
				'allows' => 'any',
			],
			'talk_supporter_insert' => [
				'title' => 'Nhân viên hỗ trợ chat',
				'allows' => 'any',
			],

		],

		/** Galleries */
		'noweb\cp\gallerycontroller' => [
			'title' => 'Module quản trị album ảnh',
			'create' => [
				'title' => 'Thêm album',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Xóa album',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Lấy thông tin album',
				'allows' => 'any',
			],
			'index' => [
				'title' => 'Danh sách album',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Sửa album',
				'allows' => 'any',
			],
			'saveorder' => [ // strtolower(action);
				'title' => 'Save galleries position',
				'allows' => 'any',
			],
			'album' => [ // strtolower(action);
				'title' => 'Albums in the gallery',
				'allows' => 'any',
			],
			'addmedia' => [ // strtolower(action);
				'title' => 'Add image to album',
				'allows' => 'any',
			],
			'getmedia' => [ // strtolower(action);
				'title' => 'Get media info via ID',
				'allows' => 'any',
			],
			'savemedia' => [ // strtolower(action);
				'title' => 'Save media info',
				'allows' => 'any',
			],
			'deletemedia' => [ // strtolower(action);
				'title' => 'Delete a media',
				'allows' => 'any',
			],
		],
		/** Widget Type */
		'noweb\cp\widgettypecontroller' => [
			'title' => 'Module quản trị loại khối nội dung',
			'create' => [
				'title' => 'Thêm loại khối',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Xóa loại khối',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Lấy thông tin loại khối',
				'allows' => 'any',
			],
			'index' => [
				'title' => 'Danh sách loại khối',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Sửa loại khối',
				'allows' => 'any',
			],
		],

		/** Widget Type */
		'noweb\cp\templatecontroller' => [
			'title' => 'Quản lý giao diện website',
			'index' => [
				'title' => 'Danh sách giao diện website',
				'allows' => 'any',
			],
			'navigation' => [
				'title' => 'Danh sách cây danh mục website',
				'allows' => 'any',
			],
			'widgetconfig' => [
				'title' => 'Lấy thông tin config widget',
				'allows' => 'any',
			],
		    'details' => [
		        'title' => 'Trang chi tiết giao diện website',
		        'allows' => 'any',
		    ],

		],

		/** Product properties */
		'noweb\cp\productpropertiescontroller' => [
			'title' => 'Quản lý các thuộc tính của sản phẩm',
			'index' => [
				'title' => 'Danh sách thuộc tính hiện tại của sản phẩm',
				'allows' => 'any',
			],
			'create' => [
				'title' => 'Thêm thuộc tính mới',
				'allows' => 'any',
			],
			'delete' => [
				'title' => 'Xóa thuộc tính',
				'allows' => 'any',
			],
			'get' => [
				'title' => 'Lấy thông tin thuộc tính',
				'allows' => 'any',
			],
			'edit' => [
				'title' => 'Sửa thuộc tính',
				'allows' => 'any',
			],

		],
	],

];