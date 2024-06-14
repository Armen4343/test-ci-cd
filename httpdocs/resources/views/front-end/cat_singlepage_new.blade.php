@php
    date_default_timezone_set("Europe/Rome");
function is_decimal( $val )
{
return is_numeric( $val ) && floor( $val ) != $val;
}

@endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ZeepUp</title>

    <link rel="icon" href="https://it.zeepup.com/front-end/images/favicon.png" type="image/png"
          sizes="64x64">
    <script src="https://code.jquery.com/jquery-3.6.4.js"
            integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://it.zeepup.com/front-end/index.css">


    <link rel="stylesheet" href="{{asset('front-end/mediaquery.css')}}">


    <!-- Stylesheets -->

    <!-- <link rel="stylesheet" href="/assets/docs.theme.min.css"> -->

    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{asset('assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owl.theme.default.min.css')}}">


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- ---- Boxicons CSS ---- -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="https://it.zeepup.com/front-end/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://it.zeepup.com/front-end/slick/slick-theme.css">


    <style>
        .form-check-input[type=checkbox] {
            border: solid 2px #ff0066 !important;
        }

        .main-color {
            color: #ff0066 !important;
        }

        .popup-content button:hover {
            background-color: #ff0066;
            color: #ffffff;
        }

        .p-1 > img {
            cursor: pointer;
        }

        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            text-align: left;
        }

        @media screen and (max-width: 767px) {
            .popup-content {
                margin: 20% auto;
                width: 100%;
            }
        }

        .popup .title {
            background: #ff0066 !important;
            color: #fff;
            padding: 10px;
        }

        .popup .content {
            padding: 20px;
        }

        .close {
            color: #fff;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .item_row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .item_col {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
        }

        .item_border {
            position: relative;

            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            /* box-shadow: 0px 0px 10px rgba(0,0,0,0.3); */
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .item_border:hover {
            transform: scale(1.05);
        }

        .item-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #fff;
        }

        .item-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .item-price {
            font-size: 16px;
            font-weight: bold;
            color: #32CD32;
            margin-bottom: 3px !important;

        }

        .origin-price {
            font-size: 13px;
            line-height: 13px;
            margin-bottom: 4px;
        }

        .original-price {
            color: #9e9e9e;
            text-decoration: line-through;
        }

        .discount {
            margin-bottom: 4px;
            margin-left: 4px;
        }

        .item-discount {
            font-size: 14px;
            color: #e74c3c;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .item-tax {
            font-size: 14px;
            color: #f39c12;
        }

        .add-to-cart {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ff0066;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .add-to-cart:hover {
            transform: scale(1.05);
        }

        .item__border {
            min-height: 203px !important;
        }
    </style>

    <style>
        /* slider css */
        .menu-container {
            position: relative;
            overflow: hidden;
        }

        .menu-wrapper {
            white-space: nowrap;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .menu-wrapper::-webkit-scrollbar {
            display: none;
        }

        .menu {
            display: inline-block;
            margin: 0;
            padding: 0;
            list-style: none;
            white-space: nowrap;
        }

        .menu li {
            display: inline-block;
        }

        .menu li a {
            display: block;
            /* padding: 10px; */
            padding: 10px 48px;
            text-decoration: none;
        }

        .arrow {
            position: absolute;
            top: 60%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;

            border-radius: 50%;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s ease-in-out;
            color: #000;
        }

        .arrow:hover {
            opacity: 1;

        }

        .arrow i:hover {
            color: #000;
        }

        .arrow-left {
            left: 30px;
        }

        .arrow-left i {
            margin: 6px 8px;
        }

        .arrow-right {
            right: -10px;
        }

        .arrow-right i {
            margin: 6px 8px;
        }

        .cart_item span {
            font-size: 12px;
            font-weight: 700;
            line-height: 18px;
            letter-spacing: 0ch;
            text-transform: none;
            color: rgb(118, 118, 118);
            margin: 0px;
            padding: 0px;
            display: block;
        }

        .cart_content {
            font-size: 18px;
            font-weight: 700;
            line-height: 24px;
            letter-spacing: -0.04ch;
            text-transform: none;
            color: rgb(25, 25, 25);
            margin: 0px;
            padding: 0px;
            display: block;
        }

        .cart_checkout {
            position: relative;
            max-width: 100%;
            margin: 15px 0;

            display: flex;
            min-height: 40px;
            width: 100%;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            border-radius: 24px;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
            user-select: none;
            text-decoration: none;
            text-align: center;
            background-color: rgb(255 6 100);
            box-shadow: transparent 0px 0px 0px 1px inset;
            color: rgb(255, 255, 255);
            justify-content: space-between;
            padding: 0px 12px;
        }

        .order_limit {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0ch;
            text-transform: none;
            color: rgb(118, 118, 118);
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile_ {
            align-items: center;
            border-left: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
            padding-top: 30px;
        }

        .hedding {
            padding-left: 10px;
            position: absolute;
            /*top: 238px;*/
            top: 386px;
            left: 98px;
            color: #fff;
        }

        .order_status {
            flex: 1 1 0%;
            margin: 4px;
            display: flex;
            flex-direction: column;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            height: 40px;
            border-radius: 8px;
            background: rgb(255 6 100);
            width: 40%;
            color: #fff;
        }

        .add_cart {
            position: relative;
            cursor: pointer;
            overflow: hidden;
            text-decoration: none;
            appearance: none;
            border: none;
            padding: 0px;
            margin: 0px;
            text-align: inherit;
            display: block;
            width: 100%;
            background: rgb(255, 255, 255);
            outline: none !important;
        }

        .cart_row {
            max-width: 100%;
            width: 100%;
            display: flex;
            column-gap: 20px;
        }

        .cart_image img {
            /* display: flex;
    -webkit-box-align: center;
    align-items: center; */
            width: 100%;
        }

        .cart_quantity {
            border-radius: 1000px;
            white-space: nowrap;
            /* box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px; */
        }

        .cart_quantity span {
            padding: 0px 7px;
        }

        .cart_items span {
            font-size: 16px;
            font-weight: 500;
            line-height: 22px;
            letter-spacing: 0ch;
            text-transform: none;
            color: rgb(25, 25, 25);
            margin: 0px;
            padding: 0px;
            font-variant-ligatures: no-common-ligatures;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            max-height: 44px;
            white-space: normal;
        }

        .cart_quantity_row {
            width: 100%;
            background: rgb(247, 247, 247);
            border-radius: 1000px;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            flex-direction: row;
            justify-content: space-between;
            padding: 10px 15px;
        }

        /* .dpavUK {
    position: relative;
    max-width: 100%;
    margin: 0px;
    display: inline-flex;
    min-height: 32px;
    border-radius: 100%;
    border: none;
    cursor: pointer;
    transition: background-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    user-select: none;
    text-decoration: none;
    text-align: center;
    background-color: rgb(255, 255, 255);
    box-shadow: transparent 0px 0px 0px 1px inset;
    color: rgb(73, 73, 73);
    height: 32px;
    width: 32px;
    padding: 0px;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
} */
        .AWaHY {
            display: flex;
            margin: 0px auto;
            padding: 16px 0px 0px;
            background-color: rgb(255, 255, 255);
            /* border-bottom: 1px solid rgb(231, 231, 231); */
            position: sticky;
            top: 64px;
            z-index: 1;
            max-width: 1352px;
            padding-right: 25px;
        }

        .gYRZjj {
            position: relative;
            z-index: 0;
            padding: 10px;
        }

        .bOSevd {
            position: fixed;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            pointer-events: none;
        }

        .fnIfiZ {
            font-size: 22px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 700;
            line-height: 30px;
            letter-spacing: -0.04ch;
            text-transform: none;
            color: rgb(25, 25, 25);
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
        }

        .iLHpvC {
            padding: 20px;
            margin: 32px 0px 16px;
        }

        .dtBifI {
            width: 100%;
            position: relative;
        }

        .hasZAr {
            display: block;
            -webkit-box-flex: 1;
            flex-grow: 1;
            max-width: 100%;
            transition: opacity 0.15s ease-in-out 0s;
            opacity: 1;
        }

        .qvNNS {
            -webkit-box-flex: 2;
            flex-grow: 2;
            min-width: 0px;
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
        }

        .gqFmIV {
            position: absolute;
            right: 0px;
            bottom: 0px;
            padding-right: 12px;
            padding-bottom: 12px;
            z-index: 10;
        }

        .llutYv {
            font-size: 16px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 700;
            line-height: 18px;
            letter-spacing: 0ch;
            text-transform: none;
            text-align: center;
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .bFimUs {
            border: 1px solid rgb(231, 231, 231);
            border-radius: 4px;

            display: flex;
            flex: 5 1 0%;
            flex-direction: row;
            -webkit-box-pack: justify;
            justify-content: space-between;
            break-inside: avoid;
            padding-left: 16px;
            text-align: left;
            transition: border-color 0.25s ease 0s;
            min-height: 142px;
            font-weight: 700;
        }

        .kXzlUf {
            position: relative;
            max-width: 100%;
            margin: 0px;
            padding: 0px;
            display: flex;
            width: 100%;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            border-radius: 0px;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
            user-select: none;
            text-decoration: none;
            text-align: center;
            background-color: rgb(255, 255, 255);
            box-shadow: transparent 0px 0px 0px 1px inset;
            color: rgb(73, 73, 73);
        }

        .kzJmQw {
            display: flex;
            flex-direction: column;
            -webkit-box-pack: center;
            justify-content: center;
            max-width: 100%;
            min-height: 142px;
            min-width: 0px;
            padding-right: 0px;
        }

        .hKyAGk {
            padding: 16px;
            min-width: 142px;
            max-width: 142px;
        }

        @media screen and (min-width: 768px) {
            .hKyAGk {
                padding: 0px;
                flex: 2 1 0%;
            }
        }

        /*.iivlWR:first-child {
    margin-left: 0px;
}
*/
        .jQrDLm {
            max-width: 100%;
            margin-bottom: 12px;
        }

        .bHRmve {
            display: grid;
            grid-template-columns: repeat(2, calc(50% - 8px));
            gap: 16px;
            padding: 20px;
        }

        .dRqGTX {
            max-width: 100%;
            display: flex;
            -webkit-box-align: stretch;
            align-items: stretch;
            -webkit-box-pack: start;
            justify-content: flex-start;
            flex-direction: row;
        }

        .haVXdT {
            color: rgb(0, 131, 138) !important;
        }

        .gAnhit {
            font-size: 14px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 700;
            line-height: 20px;
            letter-spacing: -0.04ch;
            text-transform: none;
            color: rgb(25, 25, 25);
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .gPJdZR {
            max-width: 100%;
            margin-bottom: 4px;
        }

        .gJckgT {
            height: 142px;
            background-color: rgb(247, 247, 247);
        }

        .dfExeb {
            position: relative;
            max-width: 100%;
            margin: 0px;
            padding: 0px;
            display: inline-flex;
            width: auto;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: start;
            justify-content: flex-start;
            border-radius: 24px;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
            user-select: none;
            text-decoration: none;
            text-align: center;
            background-color: rgb(255 6 100);
            box-shadow: transparent 0px 0px 0px 1px inset, rgba(0, 0, 0, 0.2) 0px 2px 8px;
            color: #fff;
        }

        .hasZAr {
            display: block;
            -webkit-box-flex: 1;
            flex-grow: 1;
            max-width: 100%;
            transition: opacity 0.15s ease-in-out 0s;
            opacity: 1;
        }

        .gviwpu {
            max-width: 100%;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            flex-direction: row;
        }

        .qvNNS {
            -webkit-box-flex: 2;
            flex-grow: 2;
            min-width: 0px;
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
        }

        .hcALja {
            max-width: 100%;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            justify-content: space-between;
            flex-direction: row;
        }

        .ZGVTs {
            height: 32px;
            min-width: 32px;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
        }

        .ewYHpV {
            display: flex;
            flex-direction: row;
            -webkit-box-flex: 2;
            flex-grow: 2;
            margin: 0px 12px;
        }

        .fdnEsw {
            font-size: 14px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 700;
            line-height: 16px;
            letter-spacing: 0ch;
            text-transform: none;
            color: #fff;
            text-align: left;
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
        }

        .ciJJYj {
            font-size: 14px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 700;
            line-height: 16px;
            letter-spacing: 0ch;
            text-transform: none;
            text-align: center;
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .jZoat {
            font-size: 14px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0ch;
            text-transform: none;
            color: rgb(118, 118, 118);
            margin: 0px;
            padding: 0px;
            font-variant-ligatures: no-common-ligatures;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            max-height: 40px;
            white-space: normal;
        }

        .fNllgF {
            font-size: 14px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 700;
            line-height: 20px;
            letter-spacing: -0.04ch;
            text-transform: none;
            color: rgb(25, 25, 25);
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
        }

        .iivlWR {
            position: relative;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            height: 100%;
            vertical-align: middle;
            margin-left: 24px;
        }

        .cbxTOv {
            flex: 1 1 0%;

            white-space: nowrap;
        }

        .cCUXaO {
            position: absolute;
            bottom: 0px;
            height: 4px;
            background-color: rgb(25, 25, 25);
            width: 100%;
            border-radius: 8px 8px 0px 0px;
        }

        .banner_image .bg {
            left: 0px;
            top: 0px;
            width: 100%;
            height: 400px;
        }

        .banner_image .bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .evpnnI {
            width: 80px;
            height: 80px;
            /* position: absolute; */
            /* margin-top: -50px; */
            /* left: 50px; */
            border-radius: 10%;
            overflow: hidden;
            background-color: rgb(255, 255, 255);
            border: 2px solid rgb(255, 255, 255);
            box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px;
        }

        .APgZO {
            height: 76px;
            /* position: absolute; */
            left: 0px;
            top: 0px;
            border-radius: 10%;
            overflow: hidden;
        }

        .jFFvQw {
            width: 100%;
            /* height: 100%; */
        }

        .ebgYxg {
            -webkit-box-align: center;
            align-items: center;
            background-color: rgb(255, 255, 255);
            display: flex;
            -webkit-box-pack: justify;
            justify-content: space-between;
        }

        .cBKuvP {
            max-width: 960px;
            margin: 0px;
            padding: 16px 0px 8px;
        }

        .lnjTEj {
            max-width: 100%;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: start;
            justify-content: flex-start;
            flex-direction: row;
        }

        .iTbFCG {
            font-size: 20px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 700;
            line-height: 22px;
            letter-spacing: 0ch;
            text-transform: none;
            color: rgb(25, 25, 25);
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
        }

        .cbFhUJ {
            font-size: 14px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0ch;
            text-transform: none;
            color: rgb(118, 118, 118);
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
        }

        .jMEyAU {
            margin-left: auto;
            padding: 16px 0px 8px;
            width: 250px;
        }

        .iqVOg {
            width: 100%;
        }

        .iuNBmt {
            display: flex;
            min-height: 40px;
        }

        .cndrJF {
            font-size: 16px;
            line-height: 22px;
            letter-spacing: 0ch;
            font-weight: 500;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            color: rgb(25, 25, 25);
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            width: 100%;
            border-radius: 20px;
            z-index: 1;
            padding: 0px 24px 0px 12px;
            border: none;
            box-shadow: rgb(247, 247, 247) 0px 0px 0px 1px inset;
            background-color: rgb(247, 247, 247);
        }

        .bUbsck {
            -webkit-box-flex: 1;
            flex-grow: 1;
            background: inherit;
            max-width: 98%;
            margin: 0px auto;
        }

        .GUhxa {
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            height: 24px;
            pointer-events: none;
        }

        .gyhBSM {
            font-size: 16px;
            line-height: 22px;
            letter-spacing: 0ch;
            font-weight: 500;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            width: 100%;
            border: none;
            outline: none;
            flex: 1 1 100%;
            display: flex;
            background: inherit;
            color: currentcolor;
            appearance: none;
            margin: 0px;
            padding: 0px;
        }

        .item_row h3 {
            font-size: 18px;
        }

        .item_row p {
            font-size: 15px;
            margin: 0;
            color: rgb(130, 130, 130);
        }

        span#view-cart-link {
            color: white;
        }

        .item_border {
            border: 1px solid rgb(231, 231, 231);
            padding-right: 0;
            margin: 0 0px;
            border-radius: 10px;
            min-height: 145px;
        }

        .item_border img {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            height: 154px;
        }

        .position {
            position: relative;
            margin: 10px 0;
        }

        .item_col {
            padding-left: 16px;
            justify-content: center;
        }

        .cart_icon {
            position: absolute;
            height: 32px;
            width: 32px;
            right: 20px;
            top: 95px;
            border-radius: 50%;
            background-color: #ff0664;
            color: #fff;
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .nimage_icon {
            position: absolute;
            height: 32px;
            width: 32px;
            right: 20px;
            top: 65px;
            border-radius: 50%;
            background-color: #ff0664;
            color: #fff;
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .banner_image {
            position: relative;
        }

        .evpnnI {
            position: absolute;
            /*top: 262px;*/
            top: 381px;
            left: 16px;
        }

        /* .cart_item_image{
  width: 30%;
} */
        .cart_price h6 {
            font-size: 15px;
            margin: 10px;
        }

        .select_cart {
            background-color: #ff0664ed;
            border-radius: 20px;
            color: #fff;
            /* width: 50%; */
        }

        .select_cart i {
            padding: 10px 25px;
            font-size: 15px;
        }

        .banner_pd {
            padding: 0 65px;
        }

        .item__border {
            border: 1px solid #0000001c;
            border-radius: 8px;
            margin: 10px 8px;

        }

        .all_item_image {
            border-radius: 20px;
        }

        .all_item_image img {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            height: 100px;
            margin: 0px auto;
            object-fit: cover;
        }

        .item__border h6 {
            margin-top: 10px;
        }

        /* 06/04/2023 */
        .open_time::before {
            content: "-";
            margin: 0px 5px;
        }

        .open_now {
            color: rgb(255 11 98);
            font-size: 14px;
            line-height: 1.5;
        }

        .open_time {
            color: rgb(130, 130, 130);
            font-size: 14px;
            line-height: 1.5;
        }

        .zipcode {
            color: rgb(130, 130, 130);
            font-size: 14px;

        }

        .add_cart_ span {
            margin-top: 20px;
            margin: 10px;

        }

        .contact_details i:hover {
            color: #212529;
        }

        .btn.custom_btn {
            box-shadow: 2px 3px 4px #888888;
            padding: 0.3rem 2.5rem;
            border-radius: 20px;
            background-color: rgb(130, 130, 130) !important;
            color: white;
            font-family: Red Hat Display;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            margin: 0 10px;
        }

        .btn.custom_bt {
            box-shadow: 2px 3px 4px #888888;
            border-radius: 20px;
            background-color: rgb(130, 130, 130) !important;
            color: white;
            font-family: Red Hat Display;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;

            padding: 5px 20px;
        }

        .item a {
            font-size: 15px;
            color: #000;
            text-decoration: none;
        }

        .menu-wrapper .menu li a {
            color: #000;
            font-size: 15px;
        }

        .all_item {
            position: absolute;
            height: 32px;
            width: 32px;
            right: 16px;
            top: 72px;
            border-radius: 50%;
            background-color: #ff0664;
            color: #fff;
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .front-main h4 {
            font-size: 20px;
            font-family: DD-TTNorms, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 700;
            line-height: 22px;
            letter-spacing: 0ch;
            text-transform: none;
            color: rgb(25, 25, 25);
            margin: 0px;
            padding: 0px;
            display: block;
            font-variant-ligatures: no-common-ligatures;
        }

        .cart_item_image img {
            border-radius: 10px;
        }

        .cart_item_image {
            width: 35%;
            margin: 10px 10px;
        }

        .owl-carousel {
            position: relative;
        }

        .owl-nav .owl-next span {
            position: absolute;
            right: -6px;
            top: 75px;
        }

        .owl-nav button span {
            font-size: 30px;
        }

        .owl-nav .owl-prev span {
            position: absolute;
            top: 75px;
            left: -6px;
        }

        .owl-theme .owl-nav [class*=owl-]:hover {
            background: #869791;
            color: #000 !important;
            text-decoration: none;
        }

        .delete_icon {
            cursor: pointer;
        }

        .added_icon {
            cursor: pointer;
        }

        .decrement_icon {
            cursor: pointer;
        }

        .banner_sec1 {
            width: 60% !important;
        }

        @media only screen and (max-width: 1200px) {
            .cart_icon {
                position: absolute;
                top: 175px;
            }

            .nimage_icon {
                position: absolute;
                top: 35px;
            }

            .item_border {
                margin: 10px 0px;
            }

            /* 06/04/2023 */
            .banner_sec1 {
                display: block !important;
                margin: 15px 0px;
            }

            .open_ {
                margin: 5px 15px;
            }

            .zipcode {
                margin: 5px 15px;
            }

            .banner_sec2 {
                display: block !important;
                margin: 15px 0px;
            }

            .jMEyAU {
                margin-left: unset;
            }
        }

        @media only screen and (max-width: 1024px) {
            .cart_div {
                justify-content: unset !important;
            }
        }

        @media only screen and (max-width: 992px) {
            .cart_icon {
                position: absolute;
                top: 185px;
            }

            .banner_pd {
                padding: 0 0px;
            }

            .cart_item_image {
                width: 10%;
            }

            .cart_price {
                padding: 0 5px;
            }

            .select_cart i {
                padding: 8px 12px;
            }

            .owl-nav .owl-next span {
                top: 120px;
            }

            .owl-nav .owl-prev span {
                top: 120px;
            }
        }

        @media only screen and (max-width: 767px) {
            .cart_icon {
                position: absolute;

            }

            .banner_sec1 {
                width: 100% !important;
            }

            .nimage_icon {
                position: absolute;
                top: 65px;
            }

            .owl-nav .owl-prev span {
                top: 95px;
            }

            .owl-nav .owl-next span {
                top: 95px;
            }

            .cart_item_image {
                width: 20%;
                margin: 10px 10px;
            }
        }

        @media only screen and (max-width: 753px) {
            .custom_margin {
                margin-top: 15px;
            }
        }

        @media only screen and (max-width: 576px) {
            .cart_icon {
                position: absolute;
                top: 95px;
            }

            .nimage_icon {
                position: absolute;
                top: 60px;
            }

            .owl-nav .owl-next span {
                top: 270px;
            }

            .owl-nav .owl-prev span {
                top: 270px;
            }

            .profile_ {
                display: block !important;
            }
        }

        @media only screen and (max-width: 425px) {
            .cart_icon {
                position: absolute;
                top: 80px;
            }

            .nimage_icon {
                position: absolute;
                top: 65px;
            }

            .owl-nav .owl-next span {
                top: 220px;
            }

            .owl-nav .owl-prev span {
                top: 220px;
            }
        }

        @media only screen and (max-width: 374px) {
            .cart_icon {
                position: absolute;
                top: 120px;
            }

            .nimage_icon {
                position: absolute;
                top: 75px;
            }

            .owl-nav .owl-next span {
                top: 170px;
            }

            .owl-nav .owl-prev span {
                top: 170px;
            }
        }

        /*Rating Start*/
        .leaf-full {
            background-image: url('https://it.zeepup.com/front-end/images/leaf-full.png');
            background-size: 20px 20px;
            display: inline-block;
            width: 20px;
            height: 20px;
            content: "";

        }

        .leaf-half {
            background-image: url('https://it.zeepup.com/front-end/images/leaf-half.png');
            background-size: 20px 20px;
            display: inline-block;
            width: 20px;
            height: 20px;
            content: "";

        }

        .leaf-unfilled {
            background-image: url('https://it.zeepup.com/front-end/images/leaf-unfilled.png');
            background-size: 20px 20px;
            display: inline-block;
            width: 20px;
            height: 20px;
            content: "";

        }

        /*Rating End*/
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://it.zeepup.com/front-end/category.css" rel="stylesheet" type="text/css"/>


</head>

<body>
<!-- (((((((((((((((((((((((       navbar      ))))))))))))))))))))))) -->

<!-- addRestaurantModal -->
<div class="modal fade" id="addRestaurantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Business</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="regForm" action="">
                    @csrf
                    <!-- One "tab" for each step in the form: -->
                    <!--1-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" placeholder="Nome:" oninput="this.className = 'form-control'"
                                   class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Descrizione:</label>
                            <textarea placeholder="Enter Business description "
                                      onkeyup="checkBusinessDescription(this.value)"
                                      oninput="this.className = 'form-control'" class="form-control"
                                      name="business_description"></textarea>
                            <p class="text-danger" id="business-description-error"></p>
                        </div>
                    </div>
                    <!--2-->
                    <div class="tab">
                        <div class="row">
                            <div class="col-md-8 mb-3 ">
                                <label for="address" class="form-label">Aggiungi il tuo punto vendita:</label>
                                <input type="text" placeholder="Enter business address"
                                       oninput="this.className = 'form-control'"
                                       class="form-control" name="address">
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <label for="address" class="form-label">Indirizzo:</label>
                                <input type="text" placeholder="000" oninput="this.className = 'form-control'"
                                       class="form-control"
                                       name="street_number">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Citta:</labe>
                                <select id="city" required class="form-select cities-tb-model" name="city">
                                    <option value="" data-id="0" readonly selected disabled>Select State First</option>
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Codice Postale:</label>
                            <input type="text" name="zipcode" placeholder="Enter restaurant zip code"
                                   oninput="this.className = 'form-control'" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">State</label>
                            <select onchange="filterCitiesModal(this)" name="state" required class="form-select">
                                <option value="" data-id="0" readonly selected disabled>Select State</option>

                                <option value="Alabama" data-id="1456">Alabama</option>

                                <option value="Alaska" data-id="1400">Alaska</option>

                                <option value="American Samoa" data-id="1424">American Samoa</option>

                                <option value="Arizona" data-id="1434">Arizona</option>

                                <option value="Arkansas" data-id="1444">Arkansas</option>

                                <option value="Baker Island" data-id="1402">Baker Island</option>

                                <option value="California" data-id="1416">California</option>

                                <option value="Colorado" data-id="1450">Colorado</option>

                                <option value="Connecticut" data-id="1435">Connecticut</option>

                                <option value="Delaware" data-id="1399">Delaware</option>

                                <option value="District of Columbia" data-id="1437">District of Columbia</option>

                                <option value="Florida" data-id="1436">Florida</option>

                                <option value="Georgia" data-id="1455">Georgia</option>

                                <option value="Guam" data-id="1412">Guam</option>

                                <option value="Hawaii" data-id="1411">Hawaii</option>

                                <option value="Howland Island" data-id="1398">Howland Island</option>

                                <option value="Idaho" data-id="1460">Idaho</option>

                                <option value="Illinois" data-id="1425">Illinois</option>

                                <option value="Indiana" data-id="1440">Indiana</option>

                                <option value="Iowa" data-id="1459">Iowa</option>

                                <option value="Jarvis Island" data-id="1410">Jarvis Island</option>

                                <option value="Johnston Atoll" data-id="1428">Johnston Atoll</option>

                                <option value="Kansas" data-id="1406">Kansas</option>

                                <option value="Kentucky" data-id="1419">Kentucky</option>

                                <option value="Kingman Reef" data-id="1403">Kingman Reef</option>

                                <option value="Louisiana" data-id="1457">Louisiana</option>

                                <option value="Maine" data-id="1453">Maine</option>

                                <option value="Maryland" data-id="1401">Maryland</option>

                                <option value="Massachusetts" data-id="1433">Massachusetts</option>

                                <option value="Michigan" data-id="1426">Michigan</option>

                                <option value="Midway Atoll" data-id="1438">Midway Atoll</option>

                                <option value="Minnesota" data-id="1420">Minnesota</option>

                                <option value="Mississippi" data-id="1430">Mississippi</option>

                                <option value="Missouri" data-id="1451">Missouri</option>

                                <option value="Montana" data-id="1446">Montana</option>

                                <option value="Navassa Island" data-id="1439">Navassa Island</option>

                                <option value="Nebraska" data-id="1408">Nebraska</option>

                                <option value="Nevada" data-id="1458">Nevada</option>

                                <option value="New Hampshire" data-id="1404">New Hampshire</option>

                                <option value="New Jersey" data-id="1417">New Jersey</option>

                                <option value="New Mexico" data-id="1423">New Mexico</option>

                                <option value="New York" data-id="1452">New York</option>

                                <option value="North Carolina" data-id="1447">North Carolina</option>

                                <option value="North Dakota" data-id="1418">North Dakota</option>

                                <option value="Northern Mariana Islands" data-id="1431">Northern Mariana Islands
                                </option>

                                <option value="Ohio" data-id="4851">Ohio</option>

                                <option value="Oklahoma" data-id="1421">Oklahoma</option>

                                <option value="Oregon" data-id="1415">Oregon</option>

                                <option value="Palmyra Atoll" data-id="1448">Palmyra Atoll</option>

                                <option value="Pennsylvania" data-id="1422">Pennsylvania</option>

                                <option value="Puerto Rico" data-id="1449">Puerto Rico</option>

                                <option value="Rhode Island" data-id="1461">Rhode Island</option>

                                <option value="South Carolina" data-id="1443">South Carolina</option>

                                <option value="South Dakota" data-id="1445">South Dakota</option>

                                <option value="Tennessee" data-id="1454">Tennessee</option>

                                <option value="Texas" data-id="1407">Texas</option>

                                <option value="United States Minor Outlying Islands" data-id="1432">United States Minor
                                    Outlying
                                    Islands
                                </option>

                                <option value="United States Virgin Islands" data-id="1413">United States Virgin
                                    Islands
                                </option>

                                <option value="Utah" data-id="1414">Utah</option>

                                <option value="Vermont" data-id="1409">Vermont</option>

                                <option value="Virginia" data-id="1427">Virginia</option>

                                <option value="Wake Island" data-id="1405">Wake Island</option>

                                <option value="Washington" data-id="1462">Washington</option>

                                <option value="West Virginia" data-id="1429">West Virginia</option>

                                <option value="Wisconsin" data-id="1441">Wisconsin</option>

                                <option value="Wyoming" data-id="1442">Wyoming</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select id="country" required class="form-select" name="country">
                                <option value="US" selected>United States</option>
                            </select>
                        </div>

                    </div>
                    <!--3-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Logo (optional)</label>
                            <input type="file" name="profile_photo_path" oninput="this.className = 'form-control'"
                                   class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Banner Image (optional)</label>
                            <input type="file" name="banner_photo_path" oninput="this.className = 'form-control'"
                                   class="form-control">
                        </div>
                    </div>
                    <!--4-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Email</label>
                            <input type="email" name="email" placeholder="Enter restaurant email"
                                   onkeyup="checkEmail(this.value)"
                                   oninput="this.className = 'form-control'" class="form-control">
                            <p class="text-danger" id="email-error"></p>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Phone</label>
                            <input type="text" name="phone" placeholder="+1-000-000-0000"
                                   onkeyup="checkPhone(this.value)"
                                   pattern="[+]{1}[0-1]{1}-[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                   oninput="this.className = 'form-control'"
                                   title="e.g: +1-000-000-0000" class="form-control add-resturant-phone" value="+1">
                            <p class="text-danger" id="phone-error"></p>
                        </div>
                        <div class="mb-3">
                            <label for="manager_name" class="form-label">Contact Name</label>
                            <input type="text" placeholder="Enter contact name"
                                   oninput="this.className = 'form-control'"
                                   class="form-control" name="manager_name">
                        </div>
                    </div>
                    <!--5-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Password</label>
                            <input name="password" required type="password" id="password" value="{{old('password')}}"
                                   oninput="this.className = 'form-control'" class="form-control"
                                   placeholder="Enter new password"
                                   onkeyup="validatePassword(event)">
                            <div class="d-none my-2" style="color:red;" id="password-error">Minimum password lenght is 8
                                characters
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Confirm Password</label>
                            <input placeholder="Enter password again to confirm" id="password_confirm"
                                   value="{{old('password_confirm')}}" type="password" required name="password_confirm"
                                   oninput="this.className = 'form-control'" onkeyup="checkPassword(this.value)"
                                   class="form-control"
                                   placeholder="Enter new password">
                            <div class="d-none alert alert-danger" id="password-confirmation-error"></div>
                            <p class="text-danger" id="password-c-error"></p>
                        </div>
                    </div>
                    <!--6-->
                    <div class="tab">

                        <div class="mb-3 d-flex">
                            @php
                                $termsAndConditions = App\Models\TermsAndConditions::first();
                            @endphp
                            <input type="checkbox" value="yes" class="form-check-input me-1" name="termsandconditions"
                                   id="termsandconditions" required>
                            <label>Cliccando qui, dichiaro di aver letto e accettato i termini di ZeepUp <br/>
                                <a href="terms-and-conditions/{{$termsAndConditions['terms_and_condition']}}"
                                   class="text-decoration-none" target="_blank">Termini e Condizioni</a> e
                                <a href="terms-and-conditions/{{$termsAndConditions['privacy_policy']}}"
                                   class="text-decoration-none" target="_blank">La Politica sui Cookies</a>. </label>
                        </div>

                        <p class="text-danger" id="termsandconditions-error"></p>
                    </div>


                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <button type="button" id="skipBtn" onclick="nextPrev(1)" class="btn btn-dark"
                                    style="background:#000000;display:none;">Skip
                            </button>
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-secondary">
                                Previous
                            </button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-danger">Next
                            </button>
                        </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <button type="button" class="btn bg-white text-dark shadow rounded-0" data-bs-dismiss="modal">Close
                </button>
                <button type="button" class="btn btn-dark shadow rounded-0">Save changes</button>
            </div>
        </div>
    </div>
</div>
<style>
    .btn.show,
    .btn:first-child:active {
        border-color: transparent;
    }
</style>
<nav class="navbar py-2">
    <div class="container-fluid">
        <div>
            <button class="navbar-toggler nav-icon border-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    style="vertical-align: bottom;">
                <div><i class="fa-solid fa-bars border-none"></i>
                </div>
            </button>
            <a class="flex-start " style="text-align: bottom;" href="{{ route('home') }}"><img
                    src="{{ secure_asset('front-end/images/logo.png') }}" alt="" class="nav-logo"></a>

        </div>
        <div class="d-flex mt-2 mt-md-0">
            <div class="dropdown language-dropdown h-auto">
                <button class="login shadow btn dropdown-toggle me-2" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    US
                </button>
                <ul class="dropdown-menu">
                    {{--            <li><a class="dropdown-item" href="#" target="_blank">Spain</a></li>--}}
                    {{--            <li><a class="dropdown-item" href="#" >Italy</a></li>--}}
                    <li><a class="dropdown-item" href="https://zeepup.com/" target="_blank">UK</a></li>
                </ul>
            </div>
            <div>
                @if (Auth::check())
                    <a href="{{ secure_url(route('logout')) }} " class="login me-1 shadow  btn"
                       style="text-decoration:none;color:black;">
                        <i class="fa-solid fa-user pe-2 bg-white login-icon"></i><span class="login-text bg-white">Log
              out</span>
                    </a>
                    @if(Auth::user()->role == 'buyer')
                        <a href="{{route('buyer.dashboard')}}" class="signup btn text-capitalize"
                           style="text-decoration:none;color:white;">
                            {{ Auth::user()->name }}
                        </a>
                    @else
                        <a href="{{route('dashboard')}}" class="signup btn text-capitalize"
                           style="text-decoration:none;color:white;">
                            {{ Auth::user()->name }}
                        </a>
                    @endif

                @else
                    <a href="{{ secure_url(route('login')) }} " class="login me-1 shadow  btn"
                       style="text-decoration:none;color:black;">
                        <i class="fa-solid fa-user pe-2 bg-white login-icon"></i><span class="login-text bg-white">Accedi
              </span>
                    </a>
                    <a href="{{route('register')}}" class="signup btn" style="text-decoration:none;color:white;">
                        Registrati
                    </a>
                @endif

            </div>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar"
             aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header ">
                <h5 class="offcanvas-title " id="offcanvasDarkNavbarLabel"><img
                        src="{{ secure_asset('front-end/images/logo.png') }}" alt="" class="nav-logo-side"></h5>
                <button type="button" class="btn-close  btn-close-dark" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body  d-flex flex-column align-items-center  text-center">
                <ul class="navbar-nav ">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal"
                                            data-bs-target="#aboutUsModal">Chi siamo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                                            data-bs-target="#addRestaurantModal">Aggiungi il tuo store</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal"
                                            data-bs-target="#contactUsModal">Contattaci</a></li>

                </ul>
                <a href="{{route('register')}}">
                    <button class="signup-btn  shadow">Registrati</button>
                </a>
                <a href="{{route('login')}}">
                    <button class="login-btn me-1 shadow "><i
                            class="fa-solid fa-user pe-2 bg-white "></i><span class="bg-white">Accedi</span></button>
                </a>
            </div>
        </div>
    </div>
</nav>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>

<div class="container-fluid front-main">
    <div class="row ">
        <!-- Next Column Items -->
        <div class="col-xl-9 col-lg-9 order-lg-1 order-2 ">
            <div class="container banner_pd">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 order-lg-1 order-2 p-3 banner_image">
                        <div class="bg">

                            @if(!empty($vendor->banner_photo_path))
                                <img src="{{ asset($vendor->banner_photo_path) }}" class="cWYshb fjDMJR">
                            @else
                                <img src="{{ asset('default-banner.png') }}" class="cWYshb fjDMJR">
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="sc-a4eba1bb-5 evpnnI">
                                <div class="sc-a4eba1bb-6 APgZO">
                                    @if(!empty($vendor->profile_photo_path))
                                        <picture><img loading="eager" src="{{ asset($vendor->profile_photo_path) }}"
                                                      alt="McDonald's"
                                                      style="object-fit:contain;object-position:50% 50%"
                                                      class="styles__StyledImg-sc-1322bgy-0 jFFvQw"></picture>
                                    @else
                                        <picture><img loading="eager" src="{{ asset('default-logo.jpg') }}"
                                                      alt="McDonald's"
                                                      style="object-fit:contain;object-position:50% 50%"
                                                      class="styles__StyledImg-sc-1322bgy-0 jFFvQw"></picture>
                                    @endif
                                </div>
                            </div>
                            <div class="hedding mt-4">
                                <h1 display="block " class="text-dark">{{$vendor->name}}</h1>
                            </div>
                            <div class=" mt-4"
                                 style="right: 32px!important; padding-left: 10px; position: absolute; top: 367px;  color: #fff;">
                                @php


                                    $rating = \App\Models\Rating::where(['vendor_id' => $vendor->id])->sum('rating');
                  $total = \App\Models\Rating::where(['vendor_id' => $vendor->id])->count();
                  if($total > 0){
                  $IntAvg = intval($rating / $total);
                  $avg = round($rating / $total , 2);
                  }
                                @endphp
                                @if($total > 0)

                                    <ul type="none" class="ps-1 p-0 m-0"
                                        style="float:left;color:#76f334;background: rgba(0.5,0.5,0.5,0.6);border-radius:5px;">
                                        <li>
                                            @for ($i = $IntAvg; $i > 0; $i--)
                                                <img src="https://it.zeepup.com/front-end/images/leaf-full.png"
                                                     width="20px">
                                            @endfor

                                            @if(is_decimal($avg))
                                                <img src="https://it.zeepup.com/front-end/images/leaf-half.png"
                                                     width="20px">
                                            @endif

                                            @for ($i = $avg+1; $i <= 5; $i++)
                                                <img
                                                    src="https://it.zeepup.com/front-end/images/leaf-unfilled.png"
                                                    width="20px">
                                            @endfor

                                            <strong>{{ round($rating / $total , 2) }} ({{$total}} ratings)</strong>
                                        </li>
                                    </ul>
                                @else

                                    <div style="color:#76f334;background: rgba(0.5,0.5,0.5,0.6);border-radius:5px;"><img
                                            src="https://it.zeepup.com/front-end/images/leaf-full.png" width="20px"> Non
                                        ancora valutata!
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="profile_ d-flex">
                            <div class=" banner_sec1 d-flex align-items-center w-100 ps-1">
                                <section class="open_">
                                    @php
                                        $disableBtn = '';
                    $status = '';
                    $timingStatus = 0;
                    $availability = \App\Models\VendorAvailability::where(['vendor_id' => $vendor->id])->first();
                    if($availability){
					 // dd($availability);
                    $todayDay = strtolower(date('l'));
                    $open = $availability[$todayDay.'_open'];
                    $close = $availability[$todayDay.'_close'];
                    $st_time = strtotime($open);
                    $end_time = strtotime($close);
                    $cur_time = strtotime('now');

                    }
                                    @endphp
                                    @if(isset($availability->status) && $availability->status != '0')
                                        @if($st_time < $cur_time && $end_time > $cur_time)
                                            @php $status = 'Aperto'; @endphp
                                            <span class="open_now">Aperto</span>
                                            <span class="open_time">{{ date("H:i", strtotime($availability[$todayDay.'_open'])) }} –
                        {{ date("H:i", strtotime($availability[$todayDay.'_close'])); }}</span>
                                        @else
                                            @php $disableBtn = 'disabled';$status = 'Close now'; @endphp
                                            <span class="open_now">Chiuso</span>
                                        @endif
                                    @elseif(isset($availability->status) && $availability->status == '0')
                                        @php $disableBtn = 'disabled';$status = 'Close now'; @endphp
                                        <span class="open_now">Chiuso</span>
                                    @else
                                        @php $disableBtn = 'disabled';$status = 'Open now';$timingStatus = 1; @endphp
                                        <span class="open_now">Aperto</span>
                                        <span class="open_time">Orario non stabilito</span>
                                    @endif

                                </section>
                                <button class="btn custom_btn" id="gotocombo"
                                        style="background-color:#ffbf00!important;color:#ffffff;">Offerta!
                                </button>
                                <button class="btn custom_bt"
                                        style="background-color:#ff0066!important;">{{$vendor->zipcode}}</button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn custom_bt ms-2"
                                        style="color:#FF0066!important;background-color:#FFFFFF!important;border:none;box-shadow: 2px 3px 4px #66ff33;"
                                        data-bs-toggle="modal" data-bs-target="#rating">
                                    Rating
                                </button>
                            </div>
                            <div class="banner_sec2 d-flex align-items-center w-100 justify-content-center"
                                 style="width:45%!important">
                                <!-- <div class="email p-2">
                                            <i class="fa-solid fa-envelope"></i>
                                            <span>test@gmail.com</span>
                                        </div> -->
                                <div class="sc-d0f598d4-0 jMEyAU">
                                    <div class="Field__FieldRoot-sc-dtefz7-0 iqVOg">
                                        <div class="StackChildren__StyledStackChildren-sc-5x3aej-0 gJoNDG">
                                            <div class="Input__InputRoot-sc-1o75rg4-0 iuNBmt">
                                                <div size="12" class="Input__InputContainer-sc-1o75rg4-1 cndrJF">
                                                    <div class="Inline__StyledInline-sc-1x9qr46-0 iDYccT">
                                                        <div class="Select__IconContainer-sc-mjznt2-2 GUhxa">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                                 class="styles__StyledInlineSvg-sc-12l8vvi-0 jFpckg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                      d="M14.1922 15.6064C13.0236 16.4816 11.5723 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10C17 11.5723 16.4816 13.0236 15.6064 14.1922L20.7071 19.2929C21.0976 19.6834 21.0976 20.3166 20.7071 20.7071C20.3166 21.0976 19.6834 21.0976 19.2929 20.7071L14.1922 15.6064ZM15 10C15 12.7614 12.7614 15 10 15C7.23858 15 5 12.7614 5 10C5 7.23858 7.23858 5 10 5C12.7614 5 15 7.23858 15 10Z"
                                                                      fill="#191919"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="Input__InputContentContainer-sc-1o75rg4-2 bUbsck">
                                                        <input title="Item Search" type="search"
                                                               aria-label="Item Search" autocomplete="off"
                                                               placeholder="Cerca articolo" id="filter"
                                                               class="Input__InputContent-sc-1o75rg4-3 gyhBSM" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="contact_details p-2">
                                            <i class="fa-solid fa-phone"></i>
                                            <span>{{$vendor->phone}}</span>
                                        </div>-->
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 order-lg-1 order-2  p-3 border">
                            <div class="sc-ac33c2ca-1 ebgYxg">
                                <div class="sc-ac33c2ca-0 cBKuvP">
                                    <div class="InlineChildren__StyledInlineChildren-sc-6r2tfo-0 lnjTEj">
                                        <span display="block"
                                              class="styles__TextElement-sc-3qedjx-0 iTbFCG"> Menu</span>
                                        <div>
                                            <div>
                                                <!-- <div style="display: inline-flex;">
                                                            <button size="12" shape="Circle" kind="BUTTON/PLAIN" aria-label="Menus" aria-haspopup="true" aria-expanded="false" aria-controls="menu-dropdown-container" type="button" class="styles__StyledButtonRoot-sc-1ldytso-0 dpavUK">
                                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="styles__StyledInlineSvg-sc-12l8vvi-0 jFpckg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.29289 5.79289C3.68342 5.40237 4.31658 5.40237 4.70711 5.79289L8 9.08579L11.2929 5.79289C11.6834 5.40237 12.3166 5.40237 12.7071 5.79289C13.0976 6.18342 13.0976 6.81658 12.7071 7.20711L8.70711 11.2071C8.51957 11.3946 8.26522 11.5 8 11.5C7.73479 11.5 7.48043 11.3946 7.29289 11.2071L3.29289 7.20711C2.90237 6.81658 2.90237 6.18342 3.29289 5.79289Z" fill="currentColor"></path>
                                                                </svg>
                                                            </button>
                                                        </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <span display="block" class="styles__TextElement-sc-3qedjx-0 cbFhUJ">5:00 pm - 3:00 am</span> -->
                                </div>
                            </div>
                            <div class="sc-fe74847b-0 AWaHY">
                                <div>
                                    <div class="LayerManager__ChildrenContainer-sc-1k2ulq-0 gYRZjj">
                                        <div>
                                            <div>
                                                <div style="display: inline-flex;">
                            <span class="sc-fe74847b-5 ehMesi">
                              <button size="12" shape="Circle" kind="BUTTON/PLAIN" aria-label="Show menu categories"
                                      aria-expanded="false" type="button"
                                      class="styles__StyledButtonRoot-sc-1ldytso-0 dpavUK">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                     class="styles__StyledInlineSvg-sc-12l8vvi-0 jFpckg">
                                  <path
                                      d="M5 4C5 3.44772 5.44772 3 6 3H13C13.5523 3 14 3.44772 14 4C14 4.55228 13.5523 5 13 5H6C5.44772 5 5 4.55228 5 4Z"
                                      fill="currentColor"></path>
                                  <path
                                      d="M5 8C5 7.44772 5.44772 7 6 7H15C15.5523 7 16 7.44772 16 8C16 8.55228 15.5523 9 15 9H6C5.44772 9 5 8.55228 5 8Z"
                                      fill="currentColor"></path>
                                  <path
                                      d="M5 12C5 11.4477 5.44772 11 6 11H11C11.5523 11 12 11.4477 12 12C12 12.5523 11.5523 13 11 13H6C5.44772 13 5 12.5523 5 12Z"
                                      fill="currentColor"></path>
                                  <path
                                      d="M3.5 4C3.5 4.69036 2.94036 5.25 2.25 5.25C1.55964 5.25 1 4.69036 1 4C1 3.30964 1.55964 2.75 2.25 2.75C2.94036 2.75 3.5 3.30964 3.5 4Z"
                                      fill="currentColor"></path>
                                  <path
                                      d="M3.5 8C3.5 8.69036 2.94036 9.25 2.25 9.25C1.55964 9.25 1 8.69036 1 8C1 7.30964 1.55964 6.75 2.25 6.75C2.94036 6.75 3.5 7.30964 3.5 8Z"
                                      fill="currentColor"></path>
                                  <path
                                      d="M3.5 12C3.5 12.6904 2.94036 13.25 2.25 13.25C1.55964 13.25 1 12.6904 1 12C1 11.3096 1.55964 10.75 2.25 10.75C2.94036 10.75 3.5 11.3096 3.5 12Z"
                                      fill="currentColor"></path>
                                </svg>
                              </button>
                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="LayerManager__GatewayLayer-sc-1k2ulq-1 bOSevd"
                                         style="z-index: 1;"></div>
                                    <div class="LayerManager__GatewayLayer-sc-1k2ulq-1 bOSevd"
                                         style="z-index: 2;"></div>
                                    <div class="LayerManager__GatewayLayer-sc-1k2ulq-1 bOSevd"
                                         style="z-index: 3;"></div>
                                    <div class="LayerManager__GatewayLayer-sc-1k2ulq-1 bOSevd"
                                         style="z-index: 4;"></div>
                                    <div class="LayerManager__GatewayLayer-sc-1k2ulq-1 bOSevd"
                                         style="z-index: 5;"></div>
                                </div>

                                <div class="menu-container">
                                    <div class="menu-wrapper">
                                        <ul class="menu">
                                            @foreach($groupedItems as $cuisineName => $items)
                                                <li><a class="menuItems"
                                                       data-id="{{ str_replace(' ', '-', $cuisineName) }}"
                                                       href="#{{ str_replace(' ', '-', $cuisineName) }}">{{ $cuisineName }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="arrow arrow-left"><i class="fa-solid fa-chevron-left"></i></div>
                                <div class="arrow arrow-right"><i class="fa-solid fa-chevron-right"></i></div>

                            </div>
                        </div>

                        @if(count($allitems)>0)
                            <div>
                                <h4 class="m-3">Tutti gli articoli</h4>
                                <div class="owl-carousel owl-theme filters">
                                    @foreach($allitems as $item)
                                        @php
                                            $price = $item->price;
                  $discount = $item->discount;
//                  $tax = $item->tax;
                  $totalPrice = $price - ($discount / 100) * $price;
//                  $salePrice = $totalPrice + ($tax / 100) * $totalPrice;
                  $salePrice = $totalPrice;
                                        @endphp
                                        <div class="item" data-value="{{ $item->name }}">
                                            <div class="item__border "
                                                 cuisine="{{ $item->cuisine ? $item->cuisine->id : '' }}"
                                                 vendor_id="{{$vendor->id}}">
                                                <input type="hidden" id="expiry-date"
                                                       value="{{ isset($item->expire_date) ? Carbon\Carbon::parse($item->expire_date)->diffForHumans() : '' }}"/>
                                                <input type="hidden" id="promo-type" value="{{$item->promo}}"/>
                                                <input type="hidden" class="itemid" value="{{$item->id}}">
                                                <input type="hidden" id="quantity" value="{{$item->quantity}}"/>
                                                <input type="hidden" id="discount" value="{{$item->discount}}"/>
                                                <input type="hidden" id="allergen" value="{{$item->alergen_info}}"/>
                                                <input type="hidden" class="itemtype" value="single">
                                                <div class="all_item_image">
                                                    @if($item->image)
                                                        <img src="{{asset($item->image)}}">
                                                    @else
                                                        <img src="{{asset('default-logo.jpg')}}">
                                                    @endif
                                                </div>
                                                <span class="all_item">+</span>
                                                <div class="px-2">
                                                    <h6>{{ substr_replace($item->name, "", 30)}}</h6>
                                                    <input type="hidden" class="item-name" value="{{$item->name}}"/>
                                                    <p class="item-price">
                                                        &euro;{{ number_format($salePrice, 2, ',', '') }}</p>
                                                    @if($discount)
                                                        <div class="origin-price">
                                                            <span
                                                                class="original-price">&euro;{{number_format($price, 2, ',', '')}}</span>
                                                            <span class="discount"> -{{$discount}}%</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(count($allitems)==0 && count($menu_array)==0)
                            <div class="row item_row mt-3">
                                <div class="col">
                                    Tutto esaurito!
                                </div>
                            </div>
                        @endif
                        <!-- items menu -->
                        <div class="row item_row mt-3">
                            @foreach($groupedItems as $cuisineName => $items)
                                <h4 id="{{ str_replace(' ', '-', $cuisineName) }}" class="m-3">{{ $cuisineName }}</h4>
                                @foreach($items as $item)
                                    @php
                                        $price = $item->price;
                $discount = $item->discount;
//                $tax = $item->tax;
                $totalPrice = $price - ($discount / 100) * $price;
//                $salePrice = $totalPrice + ($tax / 100) * $totalPrice;
                $salePrice = $totalPrice;
                                    @endphp
                                    <div class="col-xl-6 position filterItemBox">
                                        <div class="row item_border"
                                             cuisine="{{$item->cuisine ? $item->cuisine->id : ''}}"
                                             vendor_id="{{$vendor->id}}">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 item_col">
                                                <h3 class="item-name name"
                                                    data-heading="{{ str_replace(' ', '-', $cuisineName) }}">
                                                    {{ $item->name }}</h3>
                                                <input type="hidden" class="item-name" value="{{$item->name}}"/>
                                                <input type="hidden" class="itemid" value="{{$item->id}}">
                                                <p class="item-description">{{ $item->description }}</p>
                                                <span
                                                    class="item-price">&euro;{{ number_format($salePrice, 2, ',', '') }}</span>
                                                <input type="hidden" id="expiry-date"
                                                       value="@if($item->expire_date!='') {{date('d-m-Y', strtotime($item->expire_date))}} @endif"/>
                                                <input type="hidden" id="promo-type" value="{{$item->promo}}"/>
                                                <input type="hidden" id="quantity" value="{{$item->quantity}}"/>
                                                <input type="hidden" id="discount" value="{{$item->discount}}"/>
                                                <input type="hidden" id="allergen" value="{{$item->alergen_info}}"/>
                                                <input type="hidden" class="itemtype" value="single">
                                                @if($discount)
                                                    <div class="origin-price">
                                                        <span
                                                            class="original-price">&euro;{{number_format($price, 2, ',', '')}}</span>
                                                        <span class="discount"> -{{$discount}}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 p-0">
                                                @if ($item->image)
                                                    <img src="{{ asset($item->image) }}" class="w-100 object-fit-cover">
                                                @else
                                                    <img src="{{asset('default-logo.jpg')}}"
                                                         class="w-100 object-fit-cover">
                                                @endif
                                            </div>
                                            <span class="cart_icon">+</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div id="popup" class="popup">
                            <div class="popup-content">
                                <div class="title d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h3 id="popup-name">Item Name</h3>
                                    </div>
                                    <div class="close d-flex align-items-center">&times;</div>
                                </div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-12">
                                            <p id="popup-description">Item Description</p>

                                        </div>
                                        <div class="col-md-6">
                                            <img src="" alt="Item Image" id="popup-image" class="w-100">
                                            <div id="combo-image-gallery">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex">
                                                <h4>Prezzo: <span id="popup-price">Item Price</span></h4>
                                                <h4>&nbsp;<del class="text-secondary"><span id="popup-del-price"></span>
                                                    </del>&nbsp;<span class="text-success"> <b id="popup-discount">Item Discount</b></span>
                                                </h4>
                                            </div>
                                            <hr/>
                                            <div>
                                                <p class="py-0 my-0">
                                                    <span id="popup-promo-type">Item Promo Type</span>
                                                </p>
                                                <p class="py-0 my-0">
                                                    <b>Quantità: </b>
                                                    <span id="popup-quantity">Item Quantity</span>
                                                </p>
                                                <p class="py-0 my-0">
                                                    <b>Da consumarsi entro: </b>
                                                    <span id="popup-expiry-date">Expiry Date</span>
                                                </p>
                                                <p class="py-0 my-0">
                                                    <b>Informazioni sugli allergeni:</b>
                                                    <span id="popup-allergen" style="word-wrap: break-word;">Item Allergen</span>
                                                </p>
                                            </div>
                                            <hr/>

                                            <p style="color:#ff0066;" class="m-0">{{ $status }}</p>

                                            <span>
                          <b>Orario di apertura: <span class="fas fa-clock" aria-hidden="true"></span> </b>
                        </span>
                                            <table class="table table-sm" style="opacity:0.3;">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Aperto</th>
                                                    <th scope="col">Chiuso</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($availability->sunday_open) && $availability->sunday_open != null)
                                                    <tr>
                                                        <th scope="row">Domenica</th>
                                                        <td>{{ date("H:i", strtotime($availability['sunday_open'])) }}</td>
                                                        <td>{{ date("H:i", strtotime($availability['sunday_close'])) }}</td>
                                                    </tr>
                                                @endif
                                                @if(isset($availability->monday_open) && $availability->monday_open != null)
                                                    <tr>
                                                        <th scope="row">Lunedi</th>
                                                        <td>{{ date("H:i", strtotime($availability['monday_open'])) }}</td>
                                                        <td>{{ date("H:i", strtotime($availability['monday_close'])) }}</td>
                                                    </tr>
                                                @endif
                                                @if(isset($availability->tuesday_open) && $availability->tuesday_open != null)
                                                    <tr>
                                                        <th scope="row">Martedì</th>
                                                        <td>{{ date("H:i", strtotime($availability['tuesday_open'])) }}</td>
                                                        <td>{{ date("H:i", strtotime($availability['tuesday_close'])) }}</td>
                                                    </tr>
                                                @endif

                                                @if(isset($availability->wednesday_open) && $availability->wednesday_open != null)
                                                    <tr>
                                                        <th scope="row">Mercoledì</th>
                                                        <td>{{ date("H:i", strtotime($availability['wednesday_open'])) }}</td>
                                                        <td>{{ date("H:i", strtotime($availability['wednesday_close'])) }}</td>
                                                    </tr>
                                                @endif

                                                @if(isset($availability->thursday_open) && $availability->thursday_open != null)
                                                    <tr>
                                                        <th scope="row">Giovedì</th>
                                                        <td>{{ date("H:i", strtotime($availability['thursday_open'])) }}</td>
                                                        <td>{{ date("H:i", strtotime($availability['thursday_close'])) }}</td>
                                                    </tr>
                                                @endif

                                                @if(isset($availability->friday_open) && $availability->friday_open != null)
                                                    <tr>
                                                        <th scope="row">Venerdì</th>
                                                        <td>{{ date("H:i", strtotime($availability['friday_open'])) }}</td>
                                                        <td>{{ date("H:i", strtotime($availability['friday_close'])) }}</td>
                                                    </tr>
                                                @endif

                                                @if(isset($availability->saturday_open) && $availability->saturday_open != null)
                                                    <tr>
                                                        <th scope="row">Sabato</th>
                                                        <td>{{ date("H:i", strtotime($availability['saturday_open'])) }}</td>
                                                        <td>{{ date("H:i", strtotime($availability['saturday_close'])) }}</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{--                    <div class="row other_items"></div>--}}

                                    @if($timingStatus == 1)
                                        <p class="text-danger">Il negozio e' momentaneamente chiuso</p>
                                    @endif
                                    <div class="d-flex justify-content-end mt-3">

                                        <button class="btn btn-dark add-to-cart" style="border:0;" {{ $disableBtn }}>
                                            Aggiungi al Carrello
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            var itemname = "";
                            var itemid = "";
                            var itemprice = "";
                            var itemimage = "";
                            var itemtype = "";
                            $(document).ready(function () {
                                $('.item_border, .item__border').on('click', function () {
                                    //var name = $(this).find('.item-name').text();
                                    itemid = $(this).find('.itemid').val();
                                    //console.log(itemid);
                                    var name = $(this).find('input.item-name').val();
                                    //itemname = name;
                                    itemtype = $(this).find('.itemtype').val();
                                    //console.log(itemtype);
                                    var vendor_id = $(this).attr('vendor_id');
                                    var cuisine = $(this).attr('cuisine');
                                    var description = $(this).find('.item-description').text();
                                    var expiryDate = $(this).find('#expiry-date').val();
                                    // if (!expiryDate) {
                                    //   expiryDate = $(this).find('.expiry-date').val();
                                    // }
                                    var promoType = $(this).find('#promo-type').val();
                                    var quantity = $(this).find('#quantity').val();
                                    var discount = $(this).find('#discount').val();
                                    var combodiscount = $(this).find('.discount').text();
                                    var allergen = $(this).find('#allergen').val();
                                    var combo_image_gallery = $(this).find('.combo-image-gallery-class').html();
                                    var price = $(this).find('.item-price').text();
                                    var origprice = $(this).find('.original-price').text();
                                    itemprice = price;
                                    var image = $(this).find('img').attr('src');
                                    itemimage = image;
                                    $.ajax({
                                        url: "{{route('cat_cuisineItems')}}",
                                        method: "get",
                                        data: {
                                            vendor_id: vendor_id,
                                            cuisine: cuisine
                                        },
                                        success: function (result) {
                                            console.log(result);
                                            if (result.items.length > 0) {
                                                console.log(result.items);
                                                var content = `<b style="margin-top: 40px">Ulteriori suggerimenti!</b>`;
                                                (result.items).forEach(function (item) {
                                                    if (item.name != name) {
                                                        if (item.image == null) {
                                                            var image = 'default-logo.jpg';
                                                        } else {
                                                            image = item.image;
                                                        }
                                                        if (item.alergen_info == null) {
                                                            var alergen_info = '';
                                                        } else {
                                                            alergen_info = item.alergen_info;
                                                        }
                                                        content += `<div class="row" >
                                                                <div class="col-md-2">
                                                                    <div class="mt-3" style="text-align: center" >
                                                                        <img src="${image}" width="70" height="70" style="margin: 0px auto">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5 pt-4">
                                                                    <div class="mt-6" >
                                                                        <b>${item.name}</b><br/>
                                                                        <div style="word-wrap: break-word;">${alergen_info}</div>
                                                                        <div style="word-wrap: break-word;">Da consumarsi entro: ${item.expire_date}</div>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-md-3 pt-4">
                                                                    <div class="mt-6">`;

                                                        if (item.discount) {
                                                            var newPrice = parseFloat(item.price) - (parseFloat(item.price) *
                                                                parseFloat(item.discount) / 100);
                                                            content += `<b>&euro;` + Number(newPrice).toLocaleString('it-IT', {
                                                                minimumFractionDigits: 2,
                                                                maximumFractionDigits: 2
                                                            }) + `</b>
                                                                <del class="text-secondary">&euro;${Number(item.price).toLocaleString('it-IT', {
                                                                minimumFractionDigits: 2,
                                                                maximumFractionDigits: 2
                                                            })}</del>
                                                              <span class="text-success">-${item.discount}%</span>`;
                                                        } else {
                                                            content += `<b>&euro;${Number(item.price).toLocaleString('it-IT', {
                                                                minimumFractionDigits: 2,
                                                                maximumFractionDigits: 2
                                                            })}</b>`;
                                                        }
                                                        content += `       </div>
                                                                </div>
																<div class="col-md-2 pt-3">
                                                                    <div class="mt-3" style="text-align: right" >
                                                                        <!--<button class="btn btn-sm btn-primary add-to-cart">Add to Cart</button>-->
                                                                        <input class="form-check-input" type="checkbox" name="item_like[]" value="${item.id}">
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>`;
                                                    }
                                                })
                                            }
                                            $('#popup .other_items').html(content);
                                        }
                                    });
                                    $('#popup-name').text(name);
                                    $('#popup-description').text(description);
                                    $('#popup-expiry-date').text(expiryDate);
                                    $('#popup-promo-type').text(promoType);
                                    if (quantity == '0') {
                                        $('#popup-quantity').html('<span style="color: #90ee90; font-size: 20px;">Out of stock</span>');
                                    } else {
                                        $('#popup-quantity').text(quantity);
                                    }


                                    if ('{{ $status }}' == 'Close now') {
                                        $(".add-to-cart").addClass('disabled');
                                    } else {
                                        if (quantity == '0') {
                                            $(".add-to-cart").addClass('disabled');
                                        } else {
                                            $(".add-to-cart").removeClass('disabled');
                                        }
                                    }

                                    if (+discount) {
                                        $('#popup-discount').text(`-${discount}%`);
                                        $('#popup-del-price').text(origprice);
                                    } else if (+combodiscount) {
                                        combodiscount = combodiscount.replace('-', '');
                                        $('#popup-discount').text(`-${combodiscount}%`);
                                        $('#popup-del-price').text(origprice);
                                    } else {
                                        $('#popup-discount').text('');
                                        $('#popup-del-price').text('');
                                    }
                                    if (allergen == '') {
                                        $('#popup-allergen').text('');
                                        $('#popup-allergen-title').hide();
                                    } else {
                                        $('#popup-allergen').text(allergen);
                                        $('#popup-allergen-title').show();
                                    }
                                    if (combo_image_gallery) {
                                        $('#combo-image-gallery').html(combo_image_gallery);
                                        $('.p-1>img').click(function () {
                                            $('#popup-image').attr('src', $(this).attr('src'));
                                            $('#popup-expiry-date').html($(this).attr('data-expire-date'));
                                        });
                                    } else {
                                        $('#combo-image-gallery').html('');
                                    }
                                    $('#popup-price').text(price);
                                    $('#popup-image').attr('src', image);
                                    $('#add-to-cart').data('item-name', name);
                                    $('#add-to-cart').data('item-price', price);
                                    $('#popup').fadeIn();
                                });
                                $('.close').on('click', function () {
                                    $('#popup').fadeOut();
                                });
                                $('#add-to-cart').on('click', function () {
                                    var name = $(this).data('item-name');
                                    var price = $(this).data('item-price');
                                    // Code to add item to cart goes here
                                    $('#popup').fadeOut();
                                });
                            });
                        </script>


{{--                        @if(count($menu_array)>0)
                            <div class="row item_row mt-3" id="combo-box">
                                <h4 class="m-3">Combo</h4>

                                @foreach($menu_array as $thismenu)
                                        <?php
                                        //$arrTitle = explode("--", $idtitle);
                                        //$nID = $arrTitle[0];
                                        //$title = $arrTitle[1];
                                        $nameArr = [];
                                        $imageArr = [];
                                        $menu = $thismenu['items'];
                                        $strExpiryDate = "";
                                        if ($thismenu['expiry_date'] != "") {
                                            $strExpiryDate = date('d-m-Y', strtotime($thismenu['expiry_date']));
                                        }
                                        ?>
                                    <div class="col-xl-6 position mt-3">
                                        <div class="row item_border combo-item">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 item_col">
                                                <input type="hidden" class="item-name"
                                                       value="{{$thismenu['menutitle']}}"/>
                                                <input type="hidden" class="itemid" value="{{ $thismenu['menuid'] }}">
                                                <input type="hidden" class="expiry-date" value="{{ $strExpiryDate }}"/>
                                                <input type="hidden" class="itemtype" value="combo">

                                                <h3 class="item-name">{{$thismenu['menutitle']}}</h3>
                                                @foreach($menu as $row)
                                                    @if($loop->first)
                                                        <p class="item-price">
                                                            &euro;{{number_format($thismenu['menu_price'], 2, ',', '')}}</p>
                                                        @if($thismenu['menu_price'] < $thismenu['orig_price'])
                                                            <span class="original-price">
                        &euro;{{number_format($thismenu['orig_price'], 2, ',', '')}}</span>
                                                            @php
                                                                $nDiscount =
                        round((($thismenu['orig_price']-$thismenu['menu_price'])/$thismenu['orig_price'])*100);
                                                            @endphp
                                                            <span class="discount"> -{{$nDiscount}}%</span>
                                                        @endif
                                                    @endif
                                                    @php
                                                        //print_r($row);
                        $nameArr[] = $row['name'];
                        if($row['image']){
                        $imageArr[] = array("image"=>$row['image'], "expiry_date"=>$row['expire_date'],
                        "description"=>$row['item_description']);
                        //$imageArr[] = array("image"=>$row['image']);
                        }
                                                    @endphp
                                                @endforeach
                                                <span class="item-description">{{ implode(" + ", $nameArr) }}</span>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 p-0">
                                                <img
                                                    src="{{ asset((isset($imageArr[0]['image'])) ? $imageArr[0]['image'] : 'default-logo.jpg') }}"
                                                    class="w-100 object-fit-cover">
                                            </div>
                                            <div class="col-12 combo-image-gallery-class" style="display:none;">
                                                <div class="d-flex flex-wrap">
                                                    @foreach($imageArr as $imageRow)
                                                        <div class="p-1">
                                                            <img src="{{ asset($imageRow['image']) }}"
                                                                 style=" height: 40px!important; width: 40px!important;"
                                                                 data-expire-date="{{ $imageRow['expiry_date'] }}"
                                                                 data-description="{{ $imageRow['description']}}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <span class="cart_icon">+</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif--}}


                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 order-lg-2 order-1 border p-3 custom_margin">
            <div class="cart_item">
                <span>Il tuo Carrello  da</span>
                <div class="cart_content mt-1 d-flex justify-content-between">
                    <div class="">
                        {{$vendor->name}}
                    </div>
                    <div class="contact_details p-2 d-flex">
                        <span>{{$vendor->phone}}</span>
                        <i class="fa-solid fa-phone d-inline-block ms-1"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col justify-content-between">
                        {{$vendor->address}}<br>{{$vendor->zipcode}}<br>{{$vendor->city}},
                        {{$vendor->state}}<br>{{$vendor->business_description}}
                    </div>
                </div>
                <div class="order_limit mt-1">
                    Ritiro al Punto Vendita
                </div>
                <a style="text-decoration:none" href="#">
                    <div id="cd-cart-trigger" class="cart_checkout d-flex">
                        <div>
                            <!--Checkout-->&nbsp;
                        </div>
                        <div style="display:inline-flex; align-items: center">(<span id="view-cart-link">
              @php
                  $cartitems = Session::get('cart.items');
              @endphp
                                @if(is_array(Session::get('cart.items')) && array_key_exists($vendor->id, Session::get('cart.items')) && is_array($cartitems["$vendor->id"]) && count($cartitems["$vendor->id"])>0)
                                    {{ count($cartitems["$vendor->id"]) }}
                                @else
                                    0
                                @endif</span>) Carrello
                        </div>
                    </div>
                </a>
            </div>
            <div class="carted_item">
                @php
                    $nCCount = 0;
                @endphp
                @if(is_array(Session::get('cart.items')) && array_key_exists($vendor->id, Session::get('cart.items')) && is_array(Session::get('cart.items')["$vendor->id"]))
                    @foreach(Session::get('cart.items')["$vendor->id"] as $key => $item)
                        <div class="add_cart_ d-flex align-items-center" data-id="{{ $key }}">
                            <div class="cart_item_image">
                                <img src="{{$item['image']}}" class="w-100">
                            </div>
                            <div class="cart_price">
                                <h6>{{ $item['name'] }}</h6>
                            </div>
                            <span>&euro;{{ number_format($item['price'], 2, ',', '') }}</span>
                        </div>
                            <?php
                            ?>
                        @php
                            $nCCount++;
          if($nCCount==2)
          {
          break;
          }
                        @endphp
                    @endforeach
                @endif
            </div>
        </div>


    </div>
    <div class="container-fluid front-main">
        <div class="row ">
            <div class="col-md-9 col-12 ps-5">
                <div class="shadow-sm p-3 mx-md-3 bg-body rounded">
                    <h4 class="">Reviews:</h4>
                    @foreach($ratings as $rating)
                        <div class="border-bottom py-3">
                            <div class="d-flex">

                                @if (!is_null($rating->profile_photo_path) && Storage::disk('s3')->exists($rating->profile_photo_path))
                                    <img src="{{ $rating->profile_photo_path}}"
                                         class="align-self-center border rounded-circle"
                                         width="45px" height="45px">
                                @else
                                    <!-- Display a default image or some alternative content -->
                                    <img src="{{ asset('default-logo.jpg')  }}"
                                         class="align-self-center border rounded-circle"
                                         width="45px" height="45px">
                                @endif

                                <h5 class="ms-2 align-self-center pt-2">{{ $rating->name }}</h5>
                            </div>
                            <div class="mb-1">
                                @php
                                    $ratingValue = $rating->rating;
                $total = 1;
                if($total > 0){
                $IntAvg = intval($ratingValue / $total);
                $avg = round($ratingValue / $total , 2);
                }
                                @endphp
                                <ul type="none" class="ps-1 p-0 m-0 " style="float:left;">
                                    <li>
                                        @for ($i = $IntAvg; $i > 0; $i--)
                                            <img src="https://it.zeepup.com/front-end/images/leaf-full.png"
                                                 width="20px">
                                        @endfor

                                        @if(is_decimal($avg))
                                            <img src="https://it.zeepup.com/front-end/images/leaf-half.png"
                                                 width="20px">
                                        @endif
                                        @for ($i = $avg+1; $i <= 5; $i++)
                                            <img
                                                src="https://it.zeepup.com/front-end/images/leaf-unfilled.png"
                                                width="20px">
                                        @endfor
                                        <span>{{ date('M, d Y', strtotime($rating->created_at)) }}</span>
                                    </li>
                                </ul>
                            </div>
                            <br/>
                            <div class="mb-2 ps-2">
                                <p>{{ $rating->comment }}</p>
                                @if($rating->reply)
                                    <h6 class="p-0 m-0 ps-3 fw-bold">{{$vendor->name}}</h6>
                                    <p class="p-0 m-0 ps-3">{{ $rating->reply }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="rating" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Rate {{$vendor->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(Auth::user())
                        @if(Auth::user()->role == 'buyer')
                            <form action="{{ route('review.store') }}" method="post"
                                  onsubmit="handleSubmit(arguments[0])">
                                @csrf
                                <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                <input type="hidden" name="rating" readonly id="unrealisticInput"
                                       class="form-control form-control-sm">

                                <div class="mb-3">

                                    <label for="details" class="form-check-label h6">Order Number <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" data-placeholder="Select an option" required="required"
                                            name="order_number">
                                        <option hidden value="">Select</option>
                                        @php


                                            @endphp
                                        @foreach($orders as $order)
                                            <option
                                                value="{{ $order->order_number }}">{{ $order->order_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <label for="review" class="form-label">Review</label>
                                    <div id="unrealisticReview"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span
                                                class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>

                                    <span class="text-danger captcha-error d-none">CAPTCHA non valido</span>
                                </div>
                                <button type="submit" class="btn btn-dark"
                                        style="background-color:#FF0066;border:none;">Submit
                                </button>
                            </form>
                        @else
                            <p class="text-danger">Non puoi aggiungere una review se non hai effettuato l'accesso!</p>
                        @endif

                    @else
                        <p class="text-danger">Non hai effettuato l'accesso, Accedi per aggiungere un commento!</p>
                        <a href="https://it.zeepup.com/login " class="login me-1 shadow  btn"
                           style="text-decoration:none;color:black;">
                            <i class="fa-solid fa-user pe-2 bg-white login-icon"></i><span class="login-text bg-white">Log in</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="wrapper">
        <div class="title-box">
            <i class="bx bx-cookie"></i>
            <h3>Cookies</h3>
        </div>
        <div class="info">
            <p>
                Il nostro sito utilizza cookie, compresi cookie analitici e di profilazione, al fine di raccogliere
                informazioni statistiche e per garantirti un’esperienza ottimizzata. Puoi accettare tutti i cookie
                oppure declinare rifiutando i cookie opzionali.
                Per maggiori informazioni consulta la nostra Cookie Policy.

            </p>
            <a href="https://drive.google.com/file/d/1RzOjbcNhRdUJZmISdEbX4RPWCrxswg9l/view?usp=drive_link"
               target="_blank" class="terms-link">Cookie Policy</a>
            <br/>
            <a href="https://drive.google.com/file/d/1iDFgRUFPiYOdQp_g5Z-G_I8Dig0hDYs4/view?usp=drive_link"
               target="_blank" class="terms-link">Termini e condizioni</a>
        </div>
        <div class="buttons">
            <button class="button" id="acceptBtn">Accetta</button>
            <button class="button" style="color: black;background: white;">Refiuta</button>
        </div>
    </div>
    <!--<button type="button" class="btn btn-primary py-3 px-4" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
            Launch Modal 04
        </button>-->
    <div class="modal" id="wizardmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close d-flex align-items-center justify-content-center"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="row gx-0">
                    <div class="col-md-6 d-flex">
                        <div class="modal-body p-5 img d-flex"
                             style="background-image: url(https://it.zeepup.com/front-end/images/bg-1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center center;">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="modal-body p-5 d-flex align-items-center">
                            <div class="text w-100 py-5">
                                <h2 class="mb-0">10<span>%</span> Off</h2>
                                <h4 class="mb-4">All Restaurants on ZeeUp platform</h4>
                                <form action="#" class="code-form">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input mb-2" type="checkbox" value="" id="terms">
                                        <label class="form-check-label" for="terms">By claiming up you are opting for
                                            ZeepUp to reciev the
                                            email and agree to <a
                                                href="https://drive.google.com/file/d/1RzOjbcNhRdUJZmISdEbX4RPWCrxswg9l/view?usp=drive_link">ZeepUp
                                                Privacy Policy</a> and <a
                                                href="https://drive.google.com/file/d/1iDFgRUFPiYOdQp_g5Z-G_I8Dig0hDYs4/view?usp=drive_link">Terms
                                                of Use</a>. Some Items may be excluded from promotions</label>
                                    </div>
                                    <button class="btn wizard-btn d-block py-3 w-100 mt-3">Claim Offer</buttton>
                                        <button class="btn btn-link d-block py-3 w-100 mt-3" data-bs-dismiss="modal">No,
                                            Thanks</buttton>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script>
            // ---- ---- Const ---- ---- //
            const cookiesBox = document.querySelector('.wrapper'),
            buttons = document.querySelectorAll('.button');

            // ---- ---- Show ---- ---- //
            const executeCodes = () => {
                if (document.cookie.includes('AlexGolovanov')) return;
                cookiesBox.classList.add('show');

                // ---- ---- Button ---- ---- //
                buttons.forEach((button) => {
                    button.addEventListener('click', () => {
                        cookiesBox.classList.remove('show');

                        // ---- ---- Time ---- ---- //
                        if (button.id == 'acceptBtn') {
                            document.cookie =
                            'cookieBy= AlexGolovanov; max-age=' + 60 * 60 * 24 * 30;
                        }
                    });
                });
            };
            window.addEventListener('load', executeCodes);
        </script>
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="https://zeepup.estatecoordinator.co.uk/front-end/slick/slick.js" type="text/javascript" charset="utf-8"></script>
        <script>
            $("#show-filters-btn").click(function(){
                $(".filter_col").addClass("show");
            });
            $("#hide-filters-btn").click(function(){
                $(".filter_col").removeClass("show");
            });
        </script> -->


    <!-- footer -->
    @include("../layouts/front/footer")
    <!--  Codes -->
    <div class="wrapper">
        <div class="title-box">
            <i class="bx bx-cookie"></i>
            <h3>Cookies Consent</h3>
        </div>
        <div class="info">
            <p>This website use cookies to help you have a superior and more relevant browsing experience on the
                website.
            </p>
            <a href="#" class="terms-link">Terms and conditions</a>
        </div>
        <div class="buttons">
            <button class="button" id="acceptBtn">Accept</button>
            <button class="button" style="color: black;background: white;">Decline</button>
        </div>
    </div>
    <!-- <button type="button" class="btn btn-primary py-3 px-4" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
            Launch Modal 04
        </button>-->
    <div class="modal" id="wizardmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close d-flex align-items-center justify-content-center"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="row gx-0">
                    <div class="col-md-6 d-flex">
                        <div class="modal-body p-5 img d-flex"
                             style="background-image: url(https://it.zeepup.com/front-end/images/bg-1.jpg);
                                background-size: cover; background-repeat: no-repeat; background-position: center center;">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="modal-body p-5 d-flex align-items-center">
                            <div class="text w-100 py-5">
                                <h2 class="mb-0">10<span>%</span> Off</h2>
                                <h4 class="mb-4">All Restaurants on ZeeUp platform</h4>
                                <form action="#" class="code-form">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input mb-2" type="checkbox" value="" id="terms">
                                        <label class="form-check-label" for="terms">By claiming up you are opting for
                                            ZeeUp to reciev the
                                            email and agree to <a href="#">ZeeUp Privacy Policy</a> and <a href="#">Terms
                                                of Use</a>. Some
                                            Items may be excluded from promotions</label>
                                    </div>
                                    <button class="btn wizard-btn d-block py-3 w-100 mt-3">Claim Offer</buttton>
                                        <button class="btn btn-link d-block py-3 w-100 mt-3" data-bs-dismiss="modal">No,
                                            Thanks</buttton>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // ---- ---- Const ---- ---- //
        const cookiesBox = document.querySelector('.wrapper'),
            buttons = document.querySelectorAll('.button');

        let cartItems = Object.values({!! json_encode(is_array(Session::get('cart.items')) && array_key_exists($vendor->id, Session::get('cart.items')) ? Session::get('cart.items', [])["$vendor->id"] : []) !!});

        // ---- ---- Show ---- ---- //
        const executeCodes = () => {
            if (document.cookie.includes('AlexGolovanov')) return;
            cookiesBox.classList.add('show');

            // ---- ---- Button ---- ---- //
            buttons.forEach((button) => {
                button.addEventListener('click', () => {
                    cookiesBox.classList.remove('show');

                    // ---- ---- Time ---- ---- //
                    if (button.id == 'acceptBtn') {
                        document.cookie =
                            'cookieBy= AlexGolovanov; max-age=' + 60 * 60 * 24 * 30;
                    }
                });
            });
        };

        window.addEventListener('load', executeCodes);
    </script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://it.zeepup.com/front-end/slick/slick.js" type="text/javascript"
            charset="utf-8"></script>

    <script>

        function handleSubmit(e) {
            if (!validateRecaptcha()) {
                e.preventDefault();
                $('.captcha-error').removeClass('d-none')
                return;
            }
            $('.captcha-error').addClass('d-none')
        }


        $('.add_cart_').click(function () {
            const id = $(this).attr('data-id');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method: "POST",
                url: "{{route('cart.remove')}}",
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: {
                    id
                },
                success: function (response) {
                    displaycart(response.items);
                }
            })
        });

        // Quantity input functionality
        $('.btn-number').click(function (e) {
            e.preventDefault();

            var input = $(this).closest('.input-group').find('input[name="quantity"]');
            var type = $(this).attr('data-type');
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                } else {
                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                }
            } else {
                input.val(1);
            }
        });

        // Handle input changes
        $('input[name="quantity"]').change(function () {
            var input = $(this);
            var value = parseInt(input.val());

            if (isNaN(value) || value < input.attr('min')) {
                input.val(input.attr('min'));
            } else if (value > input.attr('max')) {
                input.val(input.attr('max'));
            }
        });

        // Add to cart functionality
        // Add to cart functionality
        $(document).on('click', '.delete_icon', function (event) {
            event.preventDefault();
            itemid = $(this).find('.itemid').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/cart/remove',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    id: itemid, vendorid: '{{$vendor->id}}'
                },
                success: function (response) {
                    console.log(response);

                    cartItems = cartItems.filter(item => item.id !== itemid);
                    //return;
                    //alert('Item added to cart!');
                    itemhtml = '';
                    //if(response.items.length>0){
                    //ncounter = parseInt($('#view-cart-link').html());
                    displaycart(response.items);
                    //}
                    //var currHTML = $('.carted_item').html();
                    //$('.carted_item').html(currHTML+itemhtml);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Error adding item to cart');
                }
            });
        });
        $(document).on('click', '.decrement_icon', function (event) {
            event.preventDefault();
            itemid = $(this).find('.itemid').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/cart/decrement',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    id: itemid, vendorid: '{{$vendor->id}}'
                },
                success: function (response) {
                    console.log(response);
                    //return;
                    //alert('Item added to cart!');
                    displaycart(response.items);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Error adding item to cart');
                }
            });
        });
        $(document).on('click', '.added_icon', function (event) {
            event.preventDefault();
            itemid = $(this).find('.itemid').val();
            itemidorgqty = $(this).find('.itemid-org-qty').val();
            itemidcurrentqty = $(this).find('.itemid-current-qty').val();
            if (itemidorgqty == itemidcurrentqty) {
                return false
            }
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/cart/increment',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    id: itemid, vendorid: '{{$vendor->id}}'
                },
                success: function (response) {
                    //console.log(response);
                    //return;
                    //alert('Item added to cart!');

                    displaycart(response.items);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Error adding item to cart');
                }
            });
        });

        function displaycart(items) {
            itemhtml = '';
            ncounter = 0;
            $('.cd-cart-items').empty();
            var totalprice = 0;
            if (items.length > 0) {


                (items).forEach(function (item) {
                    itemli = "";
                    if (ncounter <= 1) {
                        itemhtml = itemhtml + '<div class="add_cart_ d-flex align-items-center">';
                        itemhtml = itemhtml + '<div class="cart_item_image">';
                        itemhtml = itemhtml + '<img src="' + item.image + '" class="w-100">';
                        itemhtml = itemhtml + '</div>';
                        itemhtml = itemhtml + '<div class="cart_price">';
                        itemhtml = itemhtml + '<h6>' + item.name + '</h6>';
                        itemhtml = itemhtml + '</div>';
                        itemhtml = itemhtml + '<span>&euro;' + Number(item.price).toLocaleString('it-IT', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + '</span>';
                        itemhtml = itemhtml + '</div>';
                        //itemhtml = itemhtml + '<div class="cart_div d-flex justify-content-center">';
                        //itemhtml = itemhtml + '<div class="select_cart d-flex align-items-center">';
                        //itemhtml = itemhtml + '<div class="delete_icon">';
                        //itemhtml = itemhtml + '<i class="fa-solid fa-trash"></i>';
                        //itemhtml = itemhtml + '<input class="itemid" type="hidden" value="'+item.id+'">';
                        //itemhtml = itemhtml + '</div>';
                        //itemhtml = itemhtml + '<div class="multi_cart">';
                        //itemhtml = itemhtml + item.quantity+'x';
                        //itemhtml = itemhtml + '</div>';
                        //itemhtml = itemhtml + '<div class="added_icon">';
                        //itemhtml = itemhtml + '<i class="fa-sharp fa-light fa-plus"></i>';
                        //itemhtml = itemhtml + '<input class="itemid" type="hidden" value="'+item.id+'">';
                        //itemhtml = itemhtml + '</div>';
                        //itemhtml = itemhtml + '</div>';
                        //itemhtml = itemhtml + '</div>';
                    }

                    ncounter = ncounter + 1;
                    strItemList = "";
                    if ("items" in item) {
                        /** will return true if exist */
                        strItemList = item.items + "<br>";
                    }
                    strPriceDetail = "";
                    if ("discount" in item) {
                        strPriceDetail = "Prezzo Base: &euro;" + Number(item.baseprice).toLocaleString('it-IT', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "<br>";
                        strPriceDetail = strPriceDetail + "Sconto: " + item.discount + "%<br>";
                        // strPriceDetail = strPriceDetail + "Tax: " + item.tax + "%<br>";
                        strPriceDetail = strPriceDetail + "Subtotale: &euro;" + Number(item.price).toLocaleString('it-IT', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "<br>";
                    } else {
                        strPriceDetail = "Prezzo: &euro;" + (item.baseprice ? Number(item.baseprice).toLocaleString('it-IT', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) : '0.00') + "<br>";
                        //strPriceDetail = strPriceDetail + "Tax: " + item.tax + "%<br>";
                        strPriceDetail = strPriceDetail + "<b>Totale: &euro;" + Number(item.price).toLocaleString('it-IT', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + " </b>";
                    }
                    strExpiry = "Scadenza: " + item.expiry_date + '<br>';

                    itemli = '<li><div class="container"><div class="row"><div class="col-4"><img src="' + item.image + '" class="w-100" style="width:100px !important;";></div>';
                    itemli = itemli + '<div class="col-6"><span>' + item.name + '<br><span class="cd-price">' + strItemList + strExpiry + '' + strPriceDetail + '</span></span></div>';
                    itemli = itemli + '<div class="col-2 align-items-center" style="display:inline !important; text-align-last: center; height:78px;"><br>';
                    itemli = itemli + '<div class="delete_icon" style="display:inline !important; text-align-last: center;"><i class="fa-solid fa-trash" style="color:black;"></i>';
                    itemli = itemli + '<input class="itemid" type="hidden" value="' + item.id + '"></div></div></div><div class="row"><div class="col">&nbsp;</div>';
                    itemli = itemli + '<div class="col"><div class="select_cart d-flex align-items-center"><div class="decrement_icon"><i class="fa-solid fa-minus"></i>';
                    itemli = itemli + '<input class="itemid" type="hidden" value="' + item.id + '"></div><div class="multi_cart">' + item.quantity + 'x</div>';
                    itemli = itemli + '<div class="added_icon"><i class="fa-sharp fa-light fa-plus"></i><input class="itemid" type="hidden" value="' + item.id + '"><input class="itemid-org-qty" type="hidden" value="' + item.orgqty + '" />	<input class="itemid-current-qty" type="hidden" value="' + item.quantity + '" /></div>';
                    itemli = itemli + '</div></div><div class="col">&nbsp;</div></div></div></li>';
                    $('.cd-cart-items').append(itemli);
                    totalprice = parseFloat(totalprice) + parseFloat(item.price);
                    totalprice = totalprice.toFixed(2);
                });
                $('.carted_item').html(itemhtml);
                $('#view-cart-link').html(ncounter);
                $('.close').trigger('click');
                $('.cd-cart-total').html('<p>Totale <span>&euro;' + Number(totalprice).toLocaleString('it-IT', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + '</span></p>');
                $('.checkoutlink').css('display', 'block');

            } else {
                $('.carted_item').html(itemhtml);
                $('#view-cart-link').html(ncounter);
                $('.close').trigger('click');
                $('.cd-cart-total').html('<p>Totale <span>&euro;' + totalprice.toLocaleString('it-IT', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + '</span></p>');
                $('.checkoutlink').css('display', 'none');
            }
        }

        var btnAddTocart = null;
        $(document).on('click', '.add-to-cart', function (event) {
            event.preventDefault();
            $(this).addClass('disabled');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            //var itemId = $(this).data('id');
            itemId = itemid;
            var quantity = 1; //$(this).closest('.product').find('input[name="quantity"]').val();
            var name = itemname; //$(this).closest('.dtBifI').find('.iHCvOZ').text();
            var price = itemprice; //$(this).closest('.dtBifI').find('.gIuuHU').text();
            var thsiitemtype = itemtype;
            var additionalitems = $(".form-check-input").map(function () {
                if ($(this).is(":checked"))
                    return $(this).val();
            }).get(); // <----
            //console.log(additionalitems);
            //return false;
            console.log("Add to cart clicked for item " + itemId + " with quantity " + quantity + " and name " + name);
            //return false;
            // Perform ajax call to add the item to the cart
            $.ajax({
                url: '/cart/add',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                //data: {id: itemId, quantity: quantity,price:price,name:name,itemimage:itemimage, additionalitems:additionalitems},
                data: {
                    id: itemId,
                    itemtype: thsiitemtype,
                    additionalitems: additionalitems
                },
                success: function (response) {
                    console.log(response);
                    cartItems = [...response.items];
                    //return;
                    //alert('Item added to cart!');
                    $(this).removeClass('disabled');
                    displaycart(response.items);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    $(this).removeClass('disabled');
                    alert('Errore prodotto nel carrello');
                }
            });

            // Make Ajax request to server to add item to cart
            // $.ajax({
            //url: '/cart/count',
            //type: 'POST',
            //headers: {'X-CSRF-TOKEN': csrfToken},
            //data: { id: itemId },
            //success: function(response) {
            //console.log(response);

            //Update view cart link with cart item count
            //$('#view-cart-link').text('View Cart (' + response.itemCount + ')');
            //},
            //error: function(xhr, status, error) {
            //Handle error
            //}
            //});
        });
    </script>
    <script>
        //stepper
        $(function () {

            $(document).ready(function () {
                function triggerClick(elem) {
                    $(elem).click();
                }

                var $progressWizard = $('.stepper'),
                    $tab_active,
                    $tab_prev,
                    $tab_next,
                    $btn_prev = $progressWizard.find('.prev-step'),
                    $btn_next = $progressWizard.find('.next-step'),
                    $tab_toggle = $progressWizard.find('[data-toggle="tab"]'),
                    $tooltips = $progressWizard.find('[data-toggle="tab"][title]');

                // To do:
                // Disable User select drop-down after first step.
                // Add support for payment type switching.

                //Initialize tooltips
                $tooltips.tooltip();

                //Wizard
                $tab_toggle.on('show.bs.tab', function (e) {
                    var $target = $(e.target);

                    if (!$target.parent().hasClass('active, disabled')) {
                        $target.parent().prev().addClass('completed');
                    }
                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }
                });

                // $tab_toggle.on('click', function(event) {
                //     event.preventDefault();
                //     event.stopPropagation();
                //     return false;
                // });

                $btn_next.on('click', function () {
                    $tab_active = $progressWizard.find('.active');

                    $tab_active.next().removeClass('disabled');

                    $tab_next = $tab_active.next().find('a[data-toggle="tab"]');
                    triggerClick($tab_next);

                });
                $btn_prev.click(function () {
                    $tab_active = $progressWizard.find('.active');
                    $tab_prev = $tab_active.prev().find('a[data-toggle="tab"]');
                    triggerClick($tab_prev);
                });
            });
        });

        //stepper end
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var menuWrapper = $(".menu-wrapper");
            var menu = $(".menu");
            var arrowLeft = $(".arrow-left");
            var arrowRight = $(".arrow-right");
            var scrollDistance = 100;

            arrowLeft.on("click", function () {
                menuWrapper.scrollLeft(menuWrapper.scrollLeft() - scrollDistance);
            });

            arrowRight.on("click", function () {
                menuWrapper.scrollLeft(menuWrapper.scrollLeft() + scrollDistance);
            });

            menuWrapper.on("scroll", function () {
                if (menuWrapper.scrollLeft() > 0) {
                    arrowLeft.show();
                } else {
                    arrowLeft.hide();
                }

                if (menuWrapper.scrollLeft() + menuWrapper.innerWidth() < menu.outerWidth()) {
                    arrowRight.show();
                } else {
                    arrowRight.hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                items: 5,
                loop: ($('.owl-carousel .items').length > 5),
                //rewind: true
                margin: 5,
                autoplay: false,
                autoplayTimeout: 4000,
                dots: false,
                nav: true,
                responsive: {
                    0: {
                        items: 1,

                    },
                    600: {
                        items: 3,

                    },
                    1000: {
                        items: 4,

                    },
                    1200: {
                        items: 6,

                    }
                }
                // autoplayHoverPause: true
            });
            // $('.play').on('click', function() {
            //   owl.trigger('play.owl.autoplay', [1000])
            // })
            // $('.stop').on('click', function() {
            //   owl.trigger('stop.owl.autoplay')
            // })
        })
    </script>


    <!-- javascript -->
    <script src="{{asset('assets/jquery.min.js')}}"></script>
    <script src="{{asset('assets/owl.carousel.js')}}"></script>
    <!-- vendors -->
    <script src="{{asset('assets/highlight.js')}}"></script>
    <script src="{{asset('assets/app.js')}}"></script>
    <style>
        #cd-cart {
            position: fixed;
            top: 0;
            height: 100%;
            width: 100%;
            /* header height */
            /*padding-top: 50px;*/
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            z-index: 500;
        }

        @media only screen and (min-width: 768px) {
            #cd-cart {
                width: 350px;
            }
        }

        @media only screen and (min-width: 1200px) {
            #cd-cart {
                width: 30%;
                /* header height has changed */
                padding-top: 30px;
            }
        }


        #cd-cart {
            right: -100%;
            background: #FFF;
            -webkit-transition: right 0.3s;
            -moz-transition: right 0.3s;
            transition: right 0.3s;
        }

        #cd-cart.speed-in {
            right: 0;
        }

        #cd-cart > * {
            padding: 0 1em;
        }

        #cd-cart h2 {
            font-size: 14px;
            font-size: 0.875rem;
            font-weight: bold;
            text-transform: uppercase;
            margin: 1em 0;
        }

        #cd-cart .cd-cart-items {
            padding: 0;
        }

        #cd-cart .cd-cart-items li {
            position: relative;
            padding: 1em;
            border-top: 1px solid #e0e6ef;
        }

        #cd-cart .cd-cart-items li:last-child {
            border-bottom: 1px solid #e0e6ef;
        }

        #cd-cart .cd-qty,
        #cd-cart .cd-price {
            color: #a5aebc;
        }

        #cd-cart .cd-price {
            margin-top: .4em;
        }

        #cd-cart .cd-item-remove {
            position: absolute;
            right: 1em;
            top: 50%;
            bottom: auto;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: url("../img/cd-remove-item.svg") no-repeat center center;
        }

        .no-touch #cd-cart .cd-item-remove:hover {
            background-color: #e0e6ef;
        }

        #cd-cart .cd-cart-total {
            padding-top: 1em;
            padding-bottom: 1em;
        }

        #cd-cart .cd-cart-total span {
            float: right;
        }

        #cd-cart .cd-cart-total::after {
            /* clearfix */
            content: '';
            display: table;
            clear: both;
        }

        #cd-cart .checkout-btn {
            display: block;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background: rgb(255 6 100);;
            color: #FFF;
            text-align: center;
        }

        .no-touch #cd-cart .checkout-btn:hover {
            background: rgb(255 6 100);
        }

        #cd-cart .cd-go-to-cart {
            text-align: center;
            margin: 1em 0;
        }

        #cd-cart .cd-go-to-cart a {
            text-decoration: underline;
        }

        @media only screen and (min-width: 1200px) {
            #cd-cart > * {
                padding: 0 2em;
            }

            #cd-cart .cd-cart-items li {
                padding: 1em 2em;
            }

            #cd-cart .cd-item-remove {
                right: 2em;
            }
        }

        #cd-shadow-layer {
            position: fixed;
            min-height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background: rgba(67, 87, 121, 0.6);
            cursor: pointer;
            z-index: 2;
            display: none;
        }

        #cd-shadow-layer.is-visible {
            display: block;
            -webkit-animation: cd-fade-in 0.3s;
            -moz-animation: cd-fade-in 0.3s;
            animation: cd-fade-in 0.3s;
        }
    </style>
    <div id="cd-shadow-layer"></div>

    <div id="cd-cart">
        <div id="cart-close" style="cursor:pointer;">
            <h2><i class="fa fa-close" style="font-size:36px; color: #FF0066"></i></h2>
        </div>
        <ul class="cd-cart-items">

            @php

                $total = 0;
            @endphp
            @if(is_array(Session::get('cart.items')) && array_key_exists($vendor->id, Session::get('cart.items')) && is_array(Session::get('cart.items')["$vendor->id"]))

                @foreach(Session::get('cart.items')["$vendor->id"] as $item)
                    @php
                        $total = $total + $item['price'];
        $strCalculation = "";
        $originalPrice = "";
        if($item['item_type']=='single')
        {
        $price = $item['baseprice'] * $item['quantity'];
        $discount = $item['discount'];
        //$tax = $item['tax'];
        if($discount>0)
        {
        //$originalPrice = $price + ($price * $tax/100);
        $originalPrice = $price;
        $originalPrice = $originalPrice;
        //$originalPrice = '&nbsp;<span style="text-decoration: line-through.">'.$originalPrice.'</span>';

        /*$nCalculation = $price - ($discount / 100) * $price;
        $strCalculation = $price." - ".$discount."%";
        $strCalculation = "(".$strCalculation.", Tax: ".$tax."%)";*/
        }


        }
                    @endphp
                    <li>
                        <div class="container">
                            <div class="row">
                                <div class="col-4">

                                    @if (!is_null($item['image']))
                                        <img src="{{$item['image'] }}" class="w-100" style="width:100px !important;" ;>
                                    @else
                                        <!-- Display a default image or some alternative content -->
                                        <img src="{{ asset('default-logo.jpg') }}" alt="Default Image" class="w-100"
                                             style="width:100px !important;" ;>
                                    @endif
                                </div>
                                <div class="col-6">
                <span>
                  {{ $item['name'] }}
                  <br>
                  <span class="cd-price">
                    @if(isset($item['items']))
                          {{$item['items']}}<br>
                      @endif
                    Base Price: &euro;{{number_format($item['baseprice'], 2, ',', '.')}}<br>

                    @php
                        /*Discount: {{$item['discount']}}%<br>
                    Tax: {{$item['tax']}}%<br>
                    <b>Subtotal: &euro;{{ $item['price'] }} </b>*/
                    @endphp
                    Expiry: {{ date("d-m-Y", strtotime($item['expiry_date'])) }}<br>
                    &euro;{{ number_format($item['price'], 2, ',', '') }}
                    &nbsp;<span style="text-decoration: line-through">{{$originalPrice}}</span>
                  </span>
                </span>
                                </div>
                                <div class="col-2 align-items-center"
                                     style="display:inline !important; text-align-last: center; height:78px;">
                                    <br>
                                    <div class="delete_icon"
                                         style="display:inline !important; text-align-last: center;">
                                        <i class="fa-solid fa-trash" style="color:black;"></i>
                                        <input class="itemid" type="hidden" value="{{ $item['id'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">&nbsp;</div>
                                <div class="col">
                                    <div class="select_cart d-flex align-items-center">
                                        <div class="decrement_icon">
                                            <i class="fa-solid fa-minus"></i>
                                            <input class="itemid" type="hidden" value="{{ $item['id'] }}">
                                        </div>
                                        <div class="multi_cart">
                                            {{ $item['quantity'] }}x
                                        </div>
                                        <div class="added_icon">
                                            <i class="fa-sharp fa-light fa-plus"></i>
                                            <input class="itemid" type="hidden" value="{{ $item['id'] }}">
                                            <input class="itemid-org-qty" type="hidden" value="{{ $item['orgqty'] }}"/>
                                            <input class="itemid-current-qty" type="hidden"
                                                   value="{{ $item['quantity'] }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">&nbsp;</div>
                            </div>
                        </div>
                    </li>

                @endforeach
            @endif
            <?php
            /*<li>
				<span class="cd-qty">1x</span> Product Name
				<div class="cd-price">$9.99</div>
				<a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
			</li>

			<li>
				<span class="cd-qty">2x</span> Product Name
				<div class="cd-price">$19.98</div>
				<a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
			</li>

			<li>
				<span class="cd-qty">1x</span> Product Name
				<div class="cd-price">$9.99</div>
				<a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
			</li>*/ ?>
        </ul> <!-- cd-cart-items -->

        <div class="cd-cart-total">
            <p>Totale <span>&euro;{{number_format($total, 2, ',', '')}}</span></p>
        </div> <!-- cd-cart-total -->
        <div class="checkoutlink" @if($total==0) style="display:none;" @endif>
            <a href="buyer/checkout/{{$vendor->id}}" class="checkout-btn">Procedi al Checkout</a>
        </div>


    </div> <!-- cd-cart -->


    <div class="modal fade" id="informationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Siamo Spiacenti 🕒</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Si e’ verificato un problema per ritirare o utilizzare gli articoli in carrello in un solo acquisto. Giorno e ora promozionali di ogni articolo devono corrispondere per procedere ad un unico acquisto che prevede un unico giorno e ora di ritiro. La invitiamo a modificare il carrello o procedere con acquisti separati.
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function ($) {
            //if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
            var $L = 1200,
                $menu_navigation = $('#main-nav'),
                $cart_trigger = $('#cd-cart-trigger'),
                $cart_trigger_close = $('#cart-close');
            $hamburger_icon = $('#cd-hamburger-menu'),
                $lateral_cart = $('#cd-cart'),
                $shadow_layer = $('#cd-shadow-layer');


            //open lateral menu on mobile
            $hamburger_icon.on('click', function (event) {
                event.preventDefault();
                //close cart panel (if it's open)
                $lateral_cart.removeClass('speed-in');
                toggle_panel_visibility($menu_navigation, $shadow_layer, $('body'));
            });

            //open cart
            $cart_trigger.on('click', function (event) {
                event.preventDefault();
                //close lateral menu (if it's open)
                $menu_navigation.removeClass('speed-in');
                toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
            });
            $cart_trigger_close.on('click', function (event) {
                event.preventDefault();
                //close lateral menu (if it's open)
                $menu_navigation.removeClass('speed-in');
                toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
            });


            //close lateral cart or lateral menu
            $shadow_layer.on('click', function () {
                $shadow_layer.removeClass('is-visible');
                // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
                if ($lateral_cart.hasClass('speed-in')) {
                    $lateral_cart.removeClass('speed-in').on(
                        'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                        function () {
                            $('body').removeClass('overflow-hidden');
                        });
                    $menu_navigation.removeClass('speed-in');
                } else {
                    $menu_navigation.removeClass('speed-in').on(
                        'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                        function () {
                            $('body').removeClass('overflow-hidden');
                        });
                    $lateral_cart.removeClass('speed-in');
                }
            });

            //move #main-navigation inside header on laptop
            //insert #main-navigation after header on mobile
            move_navigation($menu_navigation, $L);
            $(window).on('resize', function () {
                move_navigation($menu_navigation, $L);

                if ($(window).width() >= $L && $menu_navigation.hasClass('speed-in')) {
                    $menu_navigation.removeClass('speed-in');
                    $shadow_layer.removeClass('is-visible');
                    $('body').removeClass('overflow-hidden');
                }

            });
        });


        const checkTimeRangeIntersection = (interval1, interval2) => {
            const [start1, end1] = interval1.split('-');
            const [start2, end2] = interval2.split('-');

            return start1 <= end2 && end1 >= start2;
        };

        $('.checkout-btn').click(function (e) {
            e.stopPropagation();
            e.preventDefault();

            const href = $(this).attr('href');
            let isValid = false;

            console.log(cartItems, 'cartItems');

            if (Object.values(cartItems).length === 1) {
                window.location.href = href;

                return;
            }

            const referencePromoDays = Object.values(cartItems)[0].promoDays?.split(',').map(item => item.toLowerCase());

            if (referencePromoDays) {
                isValid = Object.values(cartItems).every((item, index) => {
                    if (index === 0) {
                        return true;
                    }
                    const itemDays = item.promoDays?.split(',');
                    const matches = itemDays?.filter((day) => referencePromoDays.includes(day.toLowerCase())).length;
                    return matches && matches > 0;
                });
            }

            if (Object.values(cartItems).every((item) => item.timeRange)) {
                const hasIntersectingRanges = Object.values(cartItems).map((item, i) => {
                    return Object.values(cartItems).slice(i + 1).every((item2) => {
                        return checkTimeRangeIntersection(item.timeRange, item2.timeRange);
                    });
                });

                isValid = hasIntersectingRanges.every((item) => item);
            }

            if (!isValid) {
                const myModal = new bootstrap.Modal($('#informationModal'))
                myModal.show()
                return;
            }

            window.location.href = href;
        })

        function toggle_panel_visibility($lateral_panel, $background_layer, $body) {
            if ($lateral_panel.hasClass('speed-in')) {
                // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
                $lateral_panel.removeClass('speed-in').one(
                    'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                    function () {
                        $body.removeClass('overflow-hidden');
                    });
                $background_layer.removeClass('is-visible');

            } else {
                $lateral_panel.addClass('speed-in').one(
                    'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                    function () {
                        $body.addClass('overflow-hidden');
                    });
                $background_layer.addClass('is-visible');
            }
        }

        function move_navigation($navigation, $MQ) {
            if ($(window).width() >= $MQ) {
                $navigation.detach();
                $navigation.appendTo('header');
            } else {
                $navigation.detach();
                $navigation.insertAfter('header');
            }
        }
    </script>


    <!--Rating Start-->
    <script>
        !(function (t) {
            var e = {};

            function r(a) {
                if (e[a]) return e[a].exports;
                var s = (e[a] = {
                    i: a,
                    l: !1,
                    exports: {}
                });
                return t[a].call(s.exports, s, s.exports, r), (s.l = !0), s.exports;
            }

            (r.m = t),
                (r.c = e),
                (r.d = function (t, e, a) {
                    r.o(t, e) || Object.defineProperty(t, e, {
                        enumerable: !0,
                        get: a
                    });
                }),
                (r.r = function (t) {
                    "undefined" != typeof Symbol &&
                    Symbol.toStringTag &&
                    Object.defineProperty(t, Symbol.toStringTag, {
                        value: "Module"
                    }),
                        Object.defineProperty(t, "__esModule", {
                            value: !0
                        });
                }),
                (r.t = function (t, e) {
                    if ((1 & e && (t = r(t)), 8 & e)) return t;
                    if (4 & e && "object" == typeof t && t && t.__esModule) return t;
                    var a = Object.create(null);
                    if (
                        (r.r(a),
                            Object.defineProperty(a, "default", {
                                enumerable: !0,
                                value: t
                            }),
                        2 & e && "string" != typeof t)
                    )
                        for (var s in t)
                            r.d(
                                a,
                                s,
                                function (e) {
                                    return t[e];
                                }.bind(null, s)
                            );
                    return a;
                }),
                (r.n = function (t) {
                    var e =
                        t && t.__esModule ?
                            function () {
                                return t.default;
                            } :
                            function () {
                                return t;
                            };
                    return r.d(e, "a", e), e;
                }),
                (r.o = function (t, e) {
                    return Object.prototype.hasOwnProperty.call(t, e);
                }),
                (r.p = ""),
                r((r.s = 0));
        })([
            function (t, e) {
                const r = {
                    value: 0,
                    stars: 5,
                    half: !1,
                    emptyStar: "far fa-star",
                    halfStar: "fas fa-star-half-alt",
                    filledStar: "fas fa-star",
                    color: "#fcd703",
                    readonly: !1,
                    click: function (t) {
                        console.error("No click callback provided!");
                    },
                };
                jQuery.fn.extend({
                    rating: function (t = {}) {
                        return this.each(function () {
                            $(this).attr("rating") && $(this).empty(),
                                (this.stars = t.value ? t.value : r.value),
                                (this.readonly = t.readonly ? t.readonly : r.readonly),
                                (this.getStars = function () {
                                    return $(this).find($("i"));
                                }),
                                $(this)
                                    .css({
                                        color: t.color ? t.color : r.color
                                    })
                                    .attr("rating", !0),
                            this.readonly ||
                            ($(this)
                                .off("mousemove")
                                .on("mousemove", function (e) {
                                    let a = t.half ? t.half : r.half;
                                    if (this.getStars().index(e.target) >= 0)
                                        if (a) {
                                            $(this)
                                                .find("i")
                                                .attr("class", t.emptyStar ? t.emptyStar : r.emptyStar);
                                            let a = 0.5;
                                            $(this)
                                                .find("i")
                                                .css({
                                                    width: $(this).find("i").outerWidth()
                                                }),
                                            e.offsetX > $(e.target).outerWidth() / 2 && (a = 1);
                                            let s = this.getStars().index(e.target) + a;
                                            for (let e = 0; e < this.getStars().length; e++)
                                                e + 0.5 < s ?
                                                    $(this.getStars()[e]).attr(
                                                        "class",
                                                        t.filledStar ? t.filledStar : r.filledStar
                                                    ) :
                                                    e < s &&
                                                    $(this.getStars()[e]).attr(
                                                        "class",
                                                        t.halfStar ? t.halfStar : r.halfStar
                                                    );
                                        } else {
                                            $(this)
                                                .find("i")
                                                .attr("class", t.emptyStar ? t.emptyStar : r.emptyStar);
                                            let a = this.getStars().index(e.target) + 1;
                                            for (let e = 0; e < this.getStars().length; e++)
                                                e < a &&
                                                $(this.getStars()[e]).attr(
                                                    "class",
                                                    t.filledStar ? t.filledStar : r.filledStar
                                                );
                                        }
                                }),
                                $(this)
                                    .off("mouseout")
                                    .on("mouseout", function (t) {
                                        this.printStars();
                                    }),
                                $(this)
                                    .off("click")
                                    .on("click", function (e) {
                                        if (t.half ? t.half : r.half) {
                                            let t = 0.5;
                                            e.offsetX > $(e.target).outerWidth() / 2 && (t = 1),
                                                (this.stars = this.getStars().index(e.target) + t);
                                        } else this.stars = this.getStars().index(e.target) + 1;
                                        (t.click ?
                                            t.click :
                                            r.click)({
                                            stars: this.stars,
                                            event: e
                                        });
                                    }));
                            const e = t.stars ? t.stars : r.stars;
                            for (let a = 0; a < e; a++) {
                                let e = $("<i></i>")
                                    .addClass(t.emptyStar ? t.emptyStar : r.emptyStar)
                                    .appendTo($(this));
                                if ((this.readonly || e.css({
                                    cursor: "pointer"
                                }), a > 1e3))
                                    return;
                            }
                            if (
                                ((this.printStars = function () {
                                    if (t.half ? t.half : r.half) {
                                        $(this)
                                            .find("i")
                                            .attr("class", t.emptyStar ? t.emptyStar : r.emptyStar);
                                        for (let e = 0; e < this.stars; e++)
                                            e < this.stars - 0.5 ?
                                                $(this.getStars()[e]).attr(
                                                    "class",
                                                    t.filledStar ? t.filledStar : r.filledStar
                                                ) :
                                                $(this.getStars()[e]).attr(
                                                    "class",
                                                    t.halfStar ? t.halfStar : r.halfStar
                                                );
                                    } else {
                                        $(this)
                                            .find("i")
                                            .attr("class", t.emptyStar ? t.emptyStar : r.emptyStar);
                                        for (let e = 0; e < this.stars; e++)
                                            $(this.getStars()[e]).attr(
                                                "class",
                                                t.filledStar ? t.filledStar : r.filledStar
                                            );
                                    }
                                }),
                                this.stars > 0)
                            ) {
                                this.printStars();
                                (t.click ? t.click : r.click)({
                                    stars: this.stars
                                });
                            }
                        });
                    },
                }),
                    $(function () {
                        $("[data-rating-stars]").each(function () {
                            let t = {},
                                e = /^data-rating\-(.+)$/;
                            $.each($(this).get(0).attributes, function (r, a) {
                                if (e.test(a.nodeName)) {
                                    let r = a.nodeName.match(e)[1];
                                    t[r] = a.nodeValue;
                                }
                            }),
                            null != t.input &&
                            (t.click = function (e) {
                                $(t.input).val(e.stars);
                            }),
                                $(this).rating(t);
                        });
                    });
            },
        ]);


        $("#unrealisticReview").rating({
            value: 0,
            stars: 5,
            emptyStar: "leaf-unfilled",
            halfStar: "leaf-half",
            filledStar: "leaf-full",
            // color: "#ff3ef9",
            half: true,
            click: function (e) {
                console.log(e);
                $("#unrealisticInput").val(e.stars);
            }
        });
    </script>

    <!--Rating End-->
    <script>
        @if(Session::has('message'))
        Swal.fire({
            text: "{{ Session::get('message') }}",
            icon: "{{ Session::get('alert-type') }}",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
        @endif


        //Goto combo
        $("#gotocombo").click(function () {
            $('html,body').animate({
                    scrollTop: $("#combo-box").offset().top - 90
                },
                'slow');
        });

        // Filter / Search

        /*   $("#filter").keyup(function() {
		var filterText = ($(this).val()).toLowerCase();

			  var testStr = '';
      // Loop through the comment list
    $('.filterItemBox').each(function() {
		testStr = ($(this).data('value')).toLowerCase();
		if(testStr.includes(filterText)){
			$(this).parent('div').removeClass('d-none');
		}
		else{
			$(this).parent('div').addClass('d-none');
		}


      // If the list item does not contain the text phrase fade it out

     /* if ($(this).data('value').search(new RegExp(filter, "i")) < 0) {
        $(this).parent().hide(); // MY CHANGE
      } else {
        $(this).parent().show(); // MY CHANGE




    });



    });
		 }*/
        $('#filter').on('input', function () {
            var $this = $(this);
            var $cards = $('.filterItemBox');
            var $cards2 = $('.item');
            var $cards3 = $('.combo-item');
            var arr = [];
            $filteredCards = $cards.each(function (i, card) {
                var $card = $(card);
                var name = $card.find('.name').first();
                name = name.text().toLowerCase();
                if (name.indexOf($this.val().toLowerCase()) !== -1) {
                    $card.show();
                    arr.push($card.find('.name').data('heading'));
                } else {
                    $card.hide();
                    $('.filterItemBox').closest('.item_row').find('h4').hide();
                }
            });

            $cards2.each(function (i, card) {
                var $card = $(card);
                var name = $card.find('.item-name').val();
                name = name.toLowerCase();
                if (name.indexOf($this.val().toLowerCase()) !== -1) {
                    $card.show();
                } else {
                    $card.hide();
                }
            });

            $cards3.each(function (i, card) {
                var $card = $(card);
                var name = $card.find('.item-name').val();
                name = name.toLowerCase();
                if (name.indexOf($this.val().toLowerCase()) !== -1) {
                    $card.show();
                } else {
                    $card.hide();
                }
            });

            $.each(arr, function (index, val) {
                $('#' + val).show();
            });
            // console.log(arr);

        });
    </script>

    <script>
        //subscription form
        $("#subscription-form").on('submit', function (e) {

            e.preventDefault();
            var form = document.querySelector('#subscription-form')
            $.ajax({
                type: 'POST',
                url: "{{route('send-subcription-email')}}",
                data: new FormData(form),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            text: data.success,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-danger"
                            }
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 10000);
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        });

        //add item end
        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function (key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>


</div>


<script>

    $('.menuItems').click(function (e) {
        e.preventDefault();
        const id = $(this).attr('data-id');
        const {top} = $(`#${id}`).offset();
        const scroll_height = top - 300;
        window.scrollBy(0, scroll_height);
    });


    function validatePassword(e) {
        passwordError = $("#password-error");
        if (e.target.value.length >= 8) {
            passwordError.addClass("d-none")
        } else {
            passwordError.removeClass("d-none")
        }
    }

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;

        if (currentTab == 2) {
            document.getElementById("skipBtn").style.display = "inline";
        } else {
            document.getElementById("skipBtn").style.display = "none";
        }
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            //document.getElementById("regForm").submit();
            $.ajax({
                // url: $(this).attr('action'),
                url: "{{ route('register.vendor.ajax') }}",
                type: "POST",
                data: new FormData(document.getElementById("regForm")),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            text: data.success,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-danger"
                            }
                        })
                        form.reset();

                    } else {
                        printErrorMsg(data.error);
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });


            //return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function (key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].querySelectorAll("input,select,textarea");
        // y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            if (y[i].name == 'business_description') {
                valid = checkBusinessDescription(y[i].value);
            } else if (y[i].name == 'email') {
                valid = checkEmail(y[i].value);
            } else if (y[i].name == 'phone') {
                valid = checkPhone(y[i].value)
            } else if (y[i].name == 'password' || y[i].name == 'password_confirm') {
                valid = checkPassword()
            } else if (y[i].name == 'termsandconditions') {
                if (document.getElementById('termsandconditions').checked) {
                    document.getElementById('termsandconditions-error').innerHTML = "";
                    valid = true
                } else {
                    document.getElementById('termsandconditions-error').innerHTML = "You didn't check it!";
                    valid = false
                }
            }
            if (!valid) {
                return valid;
            }
            // If a field is empty...
            if (y[i].value == "" && (y[i].name != 'profile_photo_path' && y[i].name != 'banner_photo_path')) {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
                break;
            } else {
                y[i].classList.remove("invalid");
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }


    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }

    // Nomi

    var temp_status = (true);

    function checkEmail(mail) {

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
            document.getElementById('email-error').innerHTML = "";
            var url = "register/vendor/check/email/ajax";
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json', // added data type
                data: {
                    "email": mail,
                    _token: CSRF_TOKEN
                },
                success: function (result) {
                    if (result.success) {
                        document.getElementById('email-error').innerHTML = "";
                        temp_status = (true);
                    } else {
                        document.getElementById('email-error').innerHTML = "This email address already registered!";
                        temp_status = (false);
                    }
                }
            });
            return temp_status
        } else {
            document.getElementById('email-error').innerHTML = "You have entered an invalid email address!";
            return (false)
        }
    }

    function checkPhone(phone) {
        var PATTERN = "[+]{1}[0-1]{1}-[0-9]{3}-[0-9]{3}-[0-9]{4}";

        if (phone.match(PATTERN)) {
            document.getElementById('phone-error').innerHTML = "";
            return (true)

        } else {
            document.getElementById('phone-error').innerHTML = "Please follow this format (e.g: +1-000-000-0000)";
            return (false)
        }
    }

    function checkBusinessDescription(text) {

        if (text.length <= 0 || text.length > 100) {
            document.getElementById('business-description-error').innerHTML =
                "Business description letter length should be in 1 to 100!";
            return (false)

        } else {
            document.getElementById('business-description-error').innerHTML = "";
            return (true)
        }
    }

    function checkPassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password_confirm").value;
        if (password != confirmPassword) {
            document.getElementById('password-c-error').innerHTML = "Passwords do not match.";
            return false;
        }
        document.getElementById('password-c-error').innerHTML = "";
        return true;
    }
</script>

<script src="https://unpkg.com/lokijs@^1.5/build/lokijs.min.js"></script>
<script>
    var db = new loki("csc.db");

    const countriesJSON =
        "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries.json";
    const statesJSON =
        "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/states.json";
    const citiesJSON =
        "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/cities.json";

    async function initializeData() {
        var countries = db.getCollection("countries");
        if (!countries) {
            countries = db.addCollection("countries");
            await fetch(countriesJSON)
                .then((response) => response.json())
                .then(async (data) => {
                    await data.forEach((c) => {
                        countries.insert(c);
                    });
                    $(".countries-tb").html(
                        `<tr> <td class="border px-4 py-2">United States - US</td></tr>`
                    );
                });
        }

        var states = db.getCollection("states");
        if (!states) {
            states = db.addCollection("states");
            await fetch(statesJSON)
                .then((response) => response.json())
                .then(async (data) => {
                    await data.forEach((d) => {
                        states.insert(d);
                    });
                });
        }

        var cities = db.getCollection("cities");
        if (!cities) {
            cities = db.addCollection("cities");
            await fetch(citiesJSON)
                .then((response) => response.json())
                .then(async (data) => {
                    await data.forEach((d) => {
                        cities.insert(d);
                    });
                });
        }
    }

    initializeData();

    async function filterCitiesModal($sid = null) {
        $sid = $sid.querySelector(":checked").getAttribute("data-id");
        let citiesColl = db.getCollection("cities");
        let cities = await citiesColl.find({
            state_id: parseInt($sid)
        });
        let $cities = $(".cities-tb-model");
        $cities.html("");
        if (cities.length) {
            await cities.forEach((c) => {
                $cities.append(`
      <option value="${c.name}">${c.name}</option>
      `);
            });
        } else {
            $cities.append(`
      <option value="No Cities Found.">No Cities Found.</option>
      `);
        }
    }

    async function filterCities($sid = null) {
        $sid = $sid.querySelector(":checked").getAttribute("data-id");
        let citiesColl = db.getCollection("cities");
        let cities = await citiesColl.find({
            state_id: parseInt($sid)
        });
        let $cities = $(".cities-tb");
        $cities.html("");
        if (cities.length) {
            await cities.forEach((c) => {
                $cities.append(`
      <option value="${c.name}">${c.name}</option>
      `);
            });
        } else {
            $cities.append(`
      <option value="No Cities Found.">No Cities Found.</option>
      `);
        }
    }


    $('.add-resturant-phone').keyup(function () {
        // Don't run for backspace key entry, otherwise it bugs out
        if (event.which != 8) {

            // Remove invalid chars from the input
            var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");
            var inputlen = input.length;
            // Get just the numbers in the input
            var numbers = this.value.replace(/\D/g, '');
            var numberslen = numbers.length;
            // Value to store the masked input
            var newval = "";

            // Loop through the existing numbers and apply the mask
            for (var i = 0; i < numberslen; i++) {
                if (i == 0) newval = "+" + numbers[i] + "-";
                else if (i == 3) newval += numbers[i] + "-";
                else if (i == 7) newval += "-" + numbers[i];
                else newval += numbers[i];
            }

            // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.
            if (inputlen >= 1 && numberslen == 0 && input[0] == "(") newval = "(";
            else if (inputlen >= 6 && numberslen == 3 && input[4] == ")" && input[5] == " ") newval += ") ";
            else if (inputlen >= 5 && numberslen == 3 && input[4] == ")") newval += " ";
            else if (inputlen >= 6 && numberslen == 3 && input[5] == " ") newval += " ";
            else if (inputlen >= 10 && numberslen == 6 && input[9] == "-") newval += "-";

            $(this).val(newval.substring(0, 15));

        }
    });
</script>
</body>

</html>
