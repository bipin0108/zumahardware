<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'home/not_found';
//Front Panel
$route['login'] = 'home/login';
$route['about-us'] = 'home/about_us';
/* category list */
$route['category'] = 'home/category';
/* subcategory of category */
$route['category/(:any)'] = 'home/subcategory_view/$1';
$route['product/(:any)/(:any)/product-list'] = 'home/subcategory_productview';
$route['search-product'] = 'home/search_product';
$route['zuma-product/(:any)/(:any)/(:any)'] = 'home/product_details/$1/$2/$3';
$route['contact-us'] = 'home/contact_us';
$route['privacy-policy'] = 'home/privacy_policy';
$route['give-rate'] = 'home/give_rate';


//Admin Panel
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = 'admin/AdminLoginController/index';
$route['admin/login'] = 'admin/AdminLoginController/index';
$route['admin/authlogincheck'] = 'admin/AdminLoginController/authlogincheck';
$route['admin/logout'] = 'admin/AdminLoginController/logout';
$route['admin/i-forgot-my-password'] = 'admin/AdminLoginController/i_forgot_my_password';
$route['admin/reset-password/(:any)'] = 'admin/AdminLoginController/reset_password/$1';
$route['admin/profile'] = 'admin/AdminLoginController/user_profile';
$route['admin/update-password'] = 'admin/AdminLoginController/change_admin_profile_password_update';
$route['admin/upload-profile'] = 'admin/AdminLoginController/change_photo';
$route['admin/profile-details-update'] = 'admin/AdminLoginController/user_update_profile_data';
$route['admin/translation-history'] = 'admin/AdminLoginController/translation_history';
$route['admin/dashboard'] = 'admin/DashboardController/index';

//Order
$route['admin/order-list'] = 'admin/OrderController/index';
$route['admin/change-status/(:any)'] = 'admin/OrderController/change_status/$1';
$route['admin/change_delivered_status/(:any)'] = 'admin/OrderController/change_delivered_status/$1';
$route['admin/view-orderitem/(:any)'] = 'admin/OrderController/view_orderitem/$1';
$route['admin/distributor-order'] = 'admin/OrderController/distributor_order';
$route['admin/pending-order'] = 'admin/OrderController/pending_order';
$route['admin/confirm-order'] = 'admin/OrderController/confirm_order';
$route['admin/delivered-order'] = 'admin/OrderController/delivered_order';
$route['admin/completed-order'] = 'admin/OrderController/completed_order';
$route['admin/update-qty'] = 'admin/OrderController/update_qty';
$route['admin/get_Item_byOrderId_ajax'] = 'admin/OrderController/get_Item_byOrderId_ajax';
//Items-Order
$route['admin/order-items-list'] = 'admin/Order_ItemsController/index';

//Report
$route['admin/order-report'] = 'admin/ReportController/order_report';
$route['admin/user_type_dropdown_ajax'] = 'admin/ReportController/user_type_dropdown_ajax';
// $route['admin/get_data'] = 'admin/ReportController/get_data';

//Category
$route['admin/category-list'] = 'admin/CategoryController/index';
$route['admin/create-category'] = 'admin/CategoryController/create_category';
$route['admin/add-category'] = 'admin/CategoryController/add_category';
$route['admin/edit-category/(:any)'] = 'admin/CategoryController/edit_category/$1';
$route['admin/update-category'] = 'admin/CategoryController/update_category';
$route['admin/trash-category'] = 'admin/CategoryController/trash_category';
//Subcategory
$route['admin/subcategory-list/(:any)'] = 'admin/SubcategoryController/index/$1';
$route['admin/create-subcategory/(:any)'] = 'admin/SubcategoryController/create_subcategory/$1';
$route['admin/add-subcategory'] = 'admin/SubcategoryController/add_subcategory';
$route['admin/edit-subcategory/(:any)/(:any)'] = 'admin/SubcategoryController/edit_subcategory/$1/$1';
$route['admin/update-subcategory'] = 'admin/SubcategoryController/update_subcategory';
$route['admin/trash-subcategory'] = 'admin/SubcategoryController/trash_subcategory';
$route['admin/subproduct-list/(:any)'] = 'admin/SubcategoryController/subproduct_list/$1';

//Slider
$route['admin/slider-list'] = 'admin/SliderController/index';
$route['admin/create-slider'] = 'admin/SliderController/create_slider';
$route['admin/add-slider'] = 'admin/SliderController/add_slider';
$route['admin/trash-slider'] = 'admin/SliderController/trash_slider';

//brand slider
$route['admin/brand-list'] = 'admin/BrandController/index';
$route['admin/create-brand'] = 'admin/BrandController/create_brand';
$route['admin/add-brand'] = 'admin/BrandController/add_brand';
$route['admin/trash-brand'] = 'admin/BrandController/trash_brand';


//Product
$route['admin/product-list'] = 'admin/ProductController/index';
$route['admin/create-product'] = 'admin/ProductController/create_product';
$route['admin/add-product'] = 'admin/ProductController/add_product';
$route['admin/get-dynamic-subcat'] = 'admin/ProductController/get_dynamic_subcat';
$route['admin/edit-product/(:any)'] = 'admin/ProductController/edit_product/$1';
$route['admin/update-product'] = 'admin/ProductController/update_product';
$route['admin/trash-product'] = 'admin/ProductController/trash_product';
$route['admin/add-image'] = 'admin/ProductController/add_image';
$route['admin/add-product-image'] = 'admin/ProductController/add_product_image';
$route['admin/trash-about-product'] = 'admin/ProductController/trash_about_product';

$route['admin/product-details/(:any)'] = 'admin/ProductController/product_details/$1';
$route['admin/trash-image'] = 'admin/ProductController/trash_image';
$route['admin/trash-product-image'] = 'admin/ProductController/trash_product_image';
$route['admin/trash-product-video'] = 'admin/ProductController/trash_product_video';
$route['admin/trash-about-product'] = 'admin/ProductController/trash_about_product';

$route['admin/save-pdf/(:any)'] = 'admin/ProductController/save_pdf/$1';
$route['admin/save-all-qr/(:any)'] = 'admin/ProductController/save_all_qr/$1';
$route['admin/download_pdf/(:any)'] = 'admin/ProductController/download_pdf/$1';
$route['admin/add-product-att'] = 'admin/ProductController/add_product_att';
$route['admin/trash-product-attribute'] = 'admin/ProductController/trash_product_attribute';
$route['admin/update-product-att'] = 'admin/ProductController/update_product_att';
$route['admin/add-att'] = 'admin/ProductController/add_att';
$route['admin/get_qr_by_productId_ajax'] = 'admin/ProductController/get_qr_by_productId_ajax';
$route['admin/hot-active-deactive-ajax'] = 'admin/ProductController/hot_active_deactive_ajax';

//Attribute
$route['admin/attribute-list'] = 'admin/AttributeController/index';
$route['admin/create-attribute'] = 'admin/AttributeController/create_attribute';
$route['admin/add-attribute'] = 'admin/AttributeController/add_attribute';
$route['admin/edit-attribute/(:any)'] = 'admin/AttributeController/edit_attribute/$1';
$route['admin/update-attribute'] = 'admin/AttributeController/update_attribute';
$route['admin/trash-attribute'] = 'admin/AttributeController/trash_attribute';

//Qr code
$route['admin/qrimages']='admin/Qrimages/index';


//user
$route['admin/user-list/(:any)'] = 'admin/UserController/index/$a';
$route['admin/create-user'] = 'admin/UserController/create_user';
$route['admin/add-user'] = 'admin/UserController/add_user';
$route['admin/edit-user'] = 'admin/UserController/edit_user';
$route['admin/update-user'] = 'admin/UserController/update_user';
$route['admin/trash-user'] = 'admin/UserController/trash_user';
$route['admin/user-details/(:any)'] = 'admin/UserController/user_details/$1';

//Distributor
$route['admin/distributor-list'] = 'admin/DistributorController/index';
$route['admin/create-distributor'] = 'admin/DistributorController/create_distributor';
$route['admin/add-distributor'] = 'admin/DistributorController/add_distributor';
$route['admin/edit-distributor'] = 'admin/DistributorController/edit_distributor';
$route['admin/update-distributor'] = 'admin/DistributorController/update_distributor';
$route['admin/trash-distributor'] = 'admin/DistributorController/trash_distributor';
$route['admin/distributor-details/(:any)'] = 'admin/DistributorController/user_details/$1';
$route['admin/dealer-list/(:any)'] = 'admin/DistributorController/dealer_list/$1';
$route['admin/carpenter-list/(:any)'] = 'admin/DistributorController/carpenter_list/$1';
$route['admin/salesman-list/(:any)'] = 'admin/DistributorController/salesman_list/$1';

//contact-us
$route['admin/contactus-list'] = 'admin/ContactusController/index';
$route['admin/trash-contactus'] = 'admin/ContactusController/trash_contactus';

//Notification
$route['admin/notification'] = 'admin/NotificationController/index';
$route['admin/send-notification'] = 'admin/NotificationController/send_notification';

//Settings
$route['admin/settings'] = 'admin/SettingsController/index';
$route['admin/update-general-settings'] = 'admin/SettingsController/update_general_settings';
$route['admin/social-settings'] = 'admin/SettingsController/social_settings';
$route['admin/privacy-policy'] = 'admin/SettingsController/privacy_policy';

//Offer
$route['admin/create-dealer-offer'] = 'admin/OfferController/create_dealer_offer';
$route['admin/create-carpenter-offer'] = 'admin/OfferController/create_carpenter_offer';
$route['admin/dealer-offer'] = 'admin/OfferController/dealer_offer';
$route['admin/carpenter-offer'] = 'admin/OfferController/carpenter_offer';
$route['admin/add-dealer-offer'] = 'admin/OfferController/add_dealer_offer';
$route['admin/add-carpenter-offer'] = 'admin/OfferController/add_carpenter_offer';
$route['admin/edit-dealer-offer/(:any)'] = 'admin/OfferController/edit_dealer_offer/$1';
$route['admin/edit-carpenter-offer/(:any)'] = 'admin/OfferController/edit_carpenter_offer/$1';
$route['admin/update-dealer-offer'] = 'admin/OfferController/update_dealer_offer';
$route['admin/update-carpenter-offer'] = 'admin/OfferController/update_carpenter_offer';
$route['admin/trash-dealer-offer'] = 'admin/OfferController/trash_dealer_offer';
$route['admin/trash-carpenter-offer'] = 'admin/OfferController/trash_carpenter_offer';

//Complaints

$route['admin/change-complaints-status/(:any)'] = 'admin/ComplaintsController/change_complaints_status/$1';
$route['admin/pending-complaints'] = 'admin/ComplaintsController/pending_complaints';
$route['admin/completed-complaints'] = 'admin/ComplaintsController/completed_complaints';


// Distributor Panel

$route['translate_uri_dashes'] = FALSE;
$route['distributor/login'] = 'distributor/DistributorLoginController/index';
$route['distributor/authlogincheck'] = 'distributor/DistributorLoginController/authlogincheck';
$route['distributor/logout'] = 'distributor/DistributorLoginController/logout';
$route['distributor/i-forgot-my-password'] = 'distributor/DistributorLoginController/i_forgot_my_password';
$route['distributor/transfer-points'] = 'distributor/DistributorLoginController/transfer_points';
// $route['admin/reset-password/(:any)'] = 'admin/AdminLoginController/reset_password/$1';
$route['distributor/profile'] = 'distributor/DistributorLoginController/user_profile';
$route['distributor/update-password'] = 'distributor/DistributorLoginController/change_distributor_profile_password_update';
$route['distributor/upload-profile'] = 'distributor/DistributorLoginController/change_photo';
$route['distributor/profile-details-update'] = 'distributor/DistributorLoginController/user_update_profile_data';
$route['distributor/dashboard'] = 'distributor/DashboardController/index';

// dealer
$route['distributor/dealer-list'] = 'distributor/DealerController/index';
$route['distributor/create-dealer'] = 'distributor/DealerController/create_dealer';
$route['distributor/add-dealer'] = 'distributor/DealerController/add_dealer';
$route['distributor/edit-dealer'] = 'distributor/DealerController/edit_dealer';
$route['distributor/update-dealer'] = 'distributor/DealerController/update_dealer';
$route['distributor/trash-dealer'] = 'distributor/DealerController/trash_dealer';
$route['distributor/dealer-translation-history/(:any)'] = 'distributor/DealerController/translation_history/$1';

// carpenter
$route['distributor/carpenter-list'] = 'distributor/CarpenterController/index';
$route['distributor/create-carpenter'] = 'distributor/CarpenterController/create_carpenter';
$route['distributor/add-carpenter'] = 'distributor/CarpenterController/add_carpenter';
$route['distributor/edit-carpenter'] = 'distributor/CarpenterController/edit_carpenter';
$route['distributor/update-carpenter'] = 'distributor/CarpenterController/update_carpenter';
$route['distributor/trash-carpenter'] = 'distributor/CarpenterController/trash_carpenter';
$route['distributor/carpenter-translation-history/(:any)'] = 'distributor/CarpenterController/carpenter_translation_history/$1';

// salesman
$route['distributor/salesman-list'] = 'distributor/SalesmanController/index';
$route['distributor/create-salesman'] = 'distributor/SalesmanController/create_salesman';
$route['distributor/add-salesman'] = 'distributor/SalesmanController/add_salesman';
$route['distributor/edit-salesman'] = 'distributor/SalesmanController/edit_salesman';
$route['distributor/update-salesman'] = 'distributor/SalesmanController/update_salesman';
$route['distributor/trash-salesman'] = 'distributor/SalesmanController/trash_salesman';

//Order
$route['distributor/order-list'] = 'distributor/OrderController/index';
$route['distributor/my-order'] = 'distributor/OrderController/my_order';
$route['distributor/view-orderitem/(:any)'] = 'distributor/OrderController/view_orderitem/$1';
$route['distributor/change-status/(:any)'] = 'distributor/OrderController/change_status/$1';
$route['distributor/change_delivered_status/(:any)'] = 'distributor/OrderController/change_delivered_status/$1';
$route['distributor/change-status-distributor/(:any)'] = 'distributor/OrderController/change_status_distributor/$1';
$route['distributor/view-order/(:any)'] = 'distributor/OrderController/view_order/$1';
$route['distributor/create-placeorder'] = 'distributor/OrderController/create_placeorder';
$route['distributor/get_product_attribute_ajax'] = 'distributor/OrderController/get_product_attribute_ajax';
$route['distributor/add-product-attribute'] = 'distributor/OrderController/add_product_attribute';
$route['distributor/place_order_ajax'] = 'distributor/OrderController/place_order_ajax';
$route['distributor/update-qty'] = 'distributor/OrderController/update_qty';
$route['distributor/get_Item_byOrderId_ajax'] = 'distributor/OrderController/get_Item_byOrderId_ajax';


$route['distributor/pending-order'] = 'distributor/OrderController/pending_order';
$route['distributor/confirm-order'] = 'distributor/OrderController/confirm_order';
$route['distributor/delivered-order'] = 'distributor/OrderController/delivered_order';
$route['distributor/completed-order'] = 'distributor/OrderController/completed_order';

//Complaints

$route['distributor/change-complaints-status/(:any)'] = 'distributor/ComplaintsController/change_complaints_status/$1';
$route['distributor/pending-complaints'] = 'distributor/ComplaintsController/pending_complaints';
$route['distributor/completed-complaints'] = 'distributor/ComplaintsController/completed_complaints';



//Report
$route['distributor/order-report'] = 'distributor/ReportController/order_report';
$route['distributor/user_type_dropdown_ajax'] = 'distributor/ReportController/user_type_dropdown_ajax';
/*
	--------------------
	|        API       |
	--------------------
*/
// Carpanter
$route['api/carpanter/login'] = 'api/ApiController/carpanter_login';
$route['api/dealer/login'] = 'api/ApiController/delear_login';


//Sendmail
$route['admin/sendmail'] = 'admin/SendmailController/index';
$route['admin/compose'] = 'admin/SendmailController/compose';
