<template>
    <!-- Top bar-->
            <div class ="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li class="mr-sm-4">
                                        <a href="tel:0969694200"><i class="fa fa-phone mr-sm-2 fa-2x"></i>
                                            <p id="info">0969694200</p>
                                            <p id="title " class="mr-sm-1">Hotline: </p>
                                        </a>
                                    </li>
                                    <li class="mr-sm-4">
                                        <a href="mailto:admin@devtest.com"><i class="fa fa-envelope mr-sm-2 fa-2x"></i>
                                            <p id="info">admin@devtest.com</p>
                                            <p id="title" class="mr-sm-1">Email: </p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2 ml-auto">
                            <div class="social-icons pull-right">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</template>

<style scoped>
/**************************
*******Top header CSS******
***************************/
.topbar{
    height: 2.55em;
    background-color: #d2691e;
}
.contactinfo ul li:first-child{
    margin-left: -15px;
}
.contactinfo ul li{
    margin-top:0.3em;
}
.contactinfo ul li a{

  font-size: 12px;
  color: #ffff;
}
.contactinfo ul li a p{
   margin-top:0.2em;
   font-weight: bold;
   float: right;
}
.contactinfo ul li a #info{
   color: rgb(0, 200, 200)
}
.contactinfo ul li a:hover{
	background:inherit;
}

.social-icons ul li a {
  border: 0 none;
  border-radius: 0;
  padding:0px;
}

.social-icons ul li{
	display:inline-block;
}

.social-icons ul li a i {
  padding: 11px 15px;
   transition: all 0.9s ease 0s;
  -moz-transition: all 0.9s ease 0s;
  -webkit-transition: all 0.9s ease 0s;
  -o-transition: all 0.9s ease 0s;
}

.social-icons ul li a i:hover{
  color: #ffff;
   transition: all 0.9s ease 0s;
  -moz-transition: all 0.9s ease 0s;
  -webkit-transition: all 0.9s ease 0s;
  -o-transition: all 0.9s ease 0s;
}

.fa-facebook{
   color: #0083C9;
}
.fa-facebook:hover {
   background: #0083C9;
}

.fa-twitter{
    color: #5BBCEC;
}
.fa-twitter:hover  {
	background:#5BBCEC;
}

.fa-google-plus {
	color:#CE3C2D;
}
.fa-google-plus:hover  {
	background:#CE3C2D;
}
</style>