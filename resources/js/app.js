import "./bootstrap";

import $ from "jquery";
window.$ = window.jQuery = $;

// Import file js
import modalDeleteAccount from "./modalDeleteAccount";
import checkAll from "./checkAll";
import roleCheckAll from "./roleCheckAll";
import loadingState from "./loadingState";
import adminValidation from "./adminValidation";
import updateStatus from "./updateStatus";
import disabledSelect from "./disabledSelect";
import sub_img from "./sub_img";
import provisionalTotal from "./provisionalTotal";
import addCart from "./addCart";
import checkoutShip from "./checkoutShip";
import getNewOrder from "./getNewOrder";
import getNewAlert from "./getNewAlert";
import starVote from "./starVote";

import changeQuantityProductCat from "./changeQuantityProductCat";
import changeMenuOrder from "./changeMenuOrder";

import sliderProduct from "./sliderProduct";
import sliderBanner from "./sliderBanner";

import imagesUpload from "./imagesUpload";
import imagesDelete from "./imagesDelete";
import imagesRemove from "./imagesRemove";

import listProductFilter from "./listProductFilter";
import listUsersFilter from "./listUsersFilter";
import listPostFilter from "./listPostFilter";
import listPageFilter from "./listPageFilter";
import listOrderFilter from "./listOrderFilter";
import listOutOfStock from "./listOutOfStock";
import listCustomerFilter from "./listCustomerFilter";
import listReviewFilter from "./listReviewFilter";

import clientListProductFilter from "./clientListProductFilter";
import clientSearchProduct from "./clientSearchProduct";

import toggleSubmenu from "./toggleSubmenu";
import toggleAdminOptions from "./toggleAdminOptions";
import toggleChildCategories from "./toggleChildCategories";
import toggleSideBar from "./toggleSideBar";
import toggleNavbar from "./toggleNavbar";


// Cài đặt cho AJAX
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// JQUERY
$(document).ready(function () {
    modalDeleteAccount();
    checkAll();
    roleCheckAll();
    loadingState();
    adminValidation();
    updateStatus();
    disabledSelect();
    sub_img();
    provisionalTotal();
    addCart();
    checkoutShip();
    starVote();

    changeQuantityProductCat();
    changeMenuOrder();

    getNewOrder();
    getNewAlert();

    sliderProduct();
    sliderBanner();

    imagesUpload();
    imagesDelete();
    imagesRemove();

    listProductFilter();
    listUsersFilter();
    listPostFilter();
    listPageFilter();
    listOrderFilter();
    listOutOfStock();
    listCustomerFilter();
    listReviewFilter();

    clientListProductFilter();
    clientSearchProduct();

    toggleSubmenu();
    toggleAdminOptions();
    toggleChildCategories();
    toggleSideBar();
    toggleNavbar();
   
});
