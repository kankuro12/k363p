<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Booking Details</title>
<style>
/* -------------------------------------
    GLOBAL
------------------------------------- */
* {
  margin: 0;
  padding: 0;
  font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
  font-size: 100%;
  line-height: 1.6;
}

img {
  max-width: 100%;
}

body {
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: none;
  width: 100%!important;
  height: 100%;
}


/* -------------------------------------
    ELEMENTS
------------------------------------- */
a {
  color: #348eda;
}

.btn-primary {
  text-decoration: none;
  color: #FFF;
  background-color: #348eda;
  border: solid #348eda;
  border-width: 5px 20px;
  line-height: 2;
  font-weight: bold;
  margin-right: 10px;
  text-align: center;
  cursor: pointer;
  display: inline-block;
  border-radius: 0px;
}

.btn-secondary {
  text-decoration: none;
  color: #FFF;
  background-color: #aaa;
  border: solid #aaa;
  border-width: 10px 20px;
  line-height: 2;
  font-weight: bold;
  margin-right: 10px;
  text-align: center;
  cursor: pointer;
  display: inline-block;
  border-radius: 25px;
}

.last {
  margin-bottom: 0;
}

.first {
  margin-top: 0;
}

.padding {
  padding: 10px 0;
}


/* -------------------------------------
    BODY
------------------------------------- */
table.body-wrap {
  width: 100%;
  padding: 20px;
}

table.body-wrap .container {
  border: 1px solid #f0f0f0;
}


/* -------------------------------------
    FOOTER
------------------------------------- */
table.footer-wrap {
  width: 100%;  
  clear: both!important;
}

.footer-wrap .container p {
  font-size: 12px;
  color: #666;
  
}

table.footer-wrap a {
  color: #999;
}


/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
  line-height: 1.1;
  margin-bottom: 15px;
  color: #000;
  margin: 40px 0 10px;
  line-height: 1.2;
  font-weight: 200;
}

h1 {
  font-size: 36px;
}
h2 {
  font-size: 28px;
}
h3 {
  font-size: 22px;
}

p, ul, ol {
  margin-bottom: 10px;
  font-weight: normal;
  font-size: 14px;
}

ul li, ol li {
  margin-left: 5px;
  list-style-position: inside;
}

/* ---------------------------------------------------
    RESPONSIVENESS
    Nuke it from orbit. It's the only way to be sure.
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
  display: block!important;
  max-width: 600px!important;
  margin: 0 auto!important; /* makes it centered */
  clear: both!important;
}

/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
  padding: 20px;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
  max-width: 600px;
  margin: 0 auto;
  display: block;
}

/* Let's make sure tables in the content area are 100% wide */
.content table {
  width: 100%;
}
.table-bordered tr{
    background-color:#fff;
    padding:5px;
}
.table-bordered tr:nth-child(even){
    background-color:#eee;
}
/*.table-bordered,.table-bordered tr,.table-bordered td{
    border:1px solid #ccc;
    border-collapse: collapse;
}*/
.table-bordered td{
    padding:0px 5px;
}
.table-bordered th{
    padding:0px 5px;
}
#header,#footer{
  padding:10px 0;
}
</style>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td>
            
             <div class="row">
                 <div class="col-lg-12 col-md-12">
                     <div class="card">
                         <div class="content">
                             <div class="content table-responsive table-full-width">
                                <div id="header">
                                  <p>
                                    
                                    Hi {{$booking->first_name." ".$booking->last_name}},
                                    <br>

                                    Your booking detail for {{$booking->room->vendor->name}}({{$booking->room->name}}).
                                  </p>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                     <tr>
                                       <td>User name</td>
                                       <td>{{$booking->first_name." ".$booking->last_name}}</td>
                                     </tr>
                                     <tr>
                                       <td>Hotel Name</td>
                                       <td>{{$booking->room->vendor->name}}</td>
                                     </tr>
                                     <tr>
                                       <td>Email Address</td>
                                       <td>{{$booking->email}}</td>
                                     </tr>
                                     <tr>
                                       <td>Check In Time</td>
                                       <td>{{$booking->check_in_time}}</td>
                                     </tr>
                                     <tr>
                                       <td>Check Out Time</td>
                                       <td>{{$booking->check_out_time}}</td>
                                     </tr>
                                     <tr>
                                       <td>Adult</td>
                                       <td>{{$booking->adult}}</td>
                                     </tr>
                                     <tr>
                                       <td>Children</td>
                                       <td>{{$booking->children}}</td>
                                     </tr>
                                     <tr>
                                       <td>Price</td>
                                       <td>{{$booking->new_price}}</td>
                                     </tr>
                                     <tr>
                                       <td>Country</td>
                                       <td>{{$booking->city->state->country->name}}</td>
                                     </tr>
                                     <tr>
                                       <td>State</td>
                                       <td>{{$booking->city->state->name}}</td>
                                     </tr>
                                     <tr>
                                       <td>City</td>
                                       <td>{{$booking->city->name}}</td>
                                     </tr>
                                     <tr>
                                       <td>Address</td>
                                       <td>{{$booking->address}}</td>
                                     </tr>
                                     <tr>
                                       <td>Payment Mode</td>
                                       <td>{{$booking->type}}</td>
                                     </tr>
                                     <tr>
                                       <td>Payment Info</td>
                                       <td>{{$booking->payment_addition_info}}</td>
                                     </tr>
                                     <tr>
                                       <td>Payment Status</td>
                                       <td>{{$booking->payment_status}}</td>
                                     </tr>

                                    </tbody>
                                </table>
                                <div id="footer">
                                  <p>
                                    Hotels Biratnagar
                                    <br>

                                    Paailatechnologies
                                    <br>

                                    Follow @paailatechnologies on Twitter
                                  </p>
                                </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
          </td>
        </tr>
      </table>
      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>
</table>
<!-- /body -->
</body>
</html>