<style type="text/css">

#navbarTogglerDemo01 > ul > li > a {
	color: #fff;
	font-weight: bold;
}

#nt {
	background-color: #fff;
}

@font-face {
	font-family: Roboto;
	src: url("http://ebykarya.local/asset/Roboto/Roboto-Regular.ttf");
	font-weight: 700;
}

#produk-terbaru .header h2 a {
	color : #333;
	text-decoration: none;
}

#produk-terbaru .header h2 {
	font-size: 130%;
	font-weight: 700;
}

.caption-pb {
	color : #d63384;
	font-size: 90%;
	font-weight: 500;
	text-shadow: 0 0 1px #e1609b;
}

.pd-h {
	font-size: 130%;
	font-weight: 700;
}
.rp {
	color : #d63384;
	font-size: 130%;
	font-weight: 700;
}

.btn-lc {
	background-color: var(--bs-pink);
	border-color: #e1609b;
	font-size: 120%;
	font-weight: 700;
	text-shadow: 0 0 1px #e1609b;
}

.btn-lc:hover {
	background-color: #e1609b;
	border-color: var(--bs-pink);
	text-shadow: 0 0 2px #d63384;
}

.btn-lc:first-child:active {
	background-color: var(--bs-pink);
	border-color: #e1609b;
}

#produk-slide > .owl-stage-outer > .owl-stage {
	display: flex;
	min-height: 250px;
}

#produk-slide > .owl-stage-outer > .owl-stage > .owl-item > .card {
	height: 100%;
}



#kategori > .kategori-item > .ic {
	min-height: 250px;
}

#kategori > .kategori-item > div.ic > a > div.card {
	height: 100%;
}

#kategori > .kategori-item > div.ic > a > div.card:hover {
	transform: scale(1.1,1.1);
	z-index: 1;
	border-color: rgba(0,0,0,.12);
	box-shadow: 0 0 .8125rem 0 rgba(0,0,0,.05);
}

#kategori > .kategori-item > div.ic > a > div.card > div.card-footer {
	border : 0;
	margin: 0;
}

 .page-load-status {
  display: none; /* hidden by default */
  padding-top: 20px;
  border-top: 1px solid #DDD;
  text-align: center;
  color: #777;
}
#head-slide  .item img{
    display: block;
    width: 100%;
    height: auto;
}

.katkat {
    margin-right: 2px;
    border-radius: 10px;
    background-color: #f9559a;
}

.katkat p {
	margin: 0;
	padding: 2px;
	color: black;
}

.hot-block {
	padding:10px 0 50px 0;
	background: #ff1493;
}

#produk-slide > div.owl-stage-outer > div.owl-stage > div.owl-item > div.card > div.card-img-overlay > div > p.card-title
{
	font-size: 80%;
	font-weight: 700;
	color: #000;
	padding: 0 3px;
	text-shadow: 0 0 2px #fff;
}
.caption-p{
	bottom: 0;
	left: 0;
	padding: 10px 5px;
	position: absolute;
	width: 100%;
	color: #ff1493;
	font-size: 90%;
	font-weight: 700;
	margin: 0;
	text-shadow: 2px -1px 4px #fff;
	text-align: center;
}

.loader-ellips {
  font-size: 20px; /* change size here */
  position: relative;
  width: 4em;
  height: 1em;
  margin: 10px auto;
}

.loader-ellips__dot {
  display: block;
  width: 1em;
  height: 1em;
  border-radius: 0.5em;
  background: #555; /* change color here */
  position: absolute;
  animation-duration: 0.5s;
  animation-timing-function: ease;
  animation-iteration-count: infinite;
}

.loader-ellips__dot:nth-child(1),
.loader-ellips__dot:nth-child(2) {
  left: 0;
}
.loader-ellips__dot:nth-child(3) { left: 1.5em; }
.loader-ellips__dot:nth-child(4) { left: 3em; }

@keyframes reveal {
  from { transform: scale(0.001); }
  to { transform: scale(1); }
}

@keyframes slide {
  to { transform: translateX(1.5em) }
}

.loader-ellips__dot:nth-child(1) {
  animation-name: reveal;
}

.loader-ellips__dot:nth-child(2),
.loader-ellips__dot:nth-child(3) {
  animation-name: slide;
}

.loader-ellips__dot:nth-child(4) {
  animation-name: reveal;
  animation-direction: reverse;
}

.scroller-status__message {
  text-align: center;
  color: #777;
}

#go-top {
  opacity: 0;
  position: fixed;
  bottom: 30px;
  right: 10px;
  z-index: 99;
  border: none;
  outline: 0;
  background-color: #d63384;
  color: #fff;
  cursor: pointer;
  padding: 10px;
  font-size: 18px;
}

@media (max-width: 575.98px) {
	.fs-1 {
	  font-size: calc(0.975rem + 1.5vw) !important;
	}

	.fs-2 {
	  font-size: calc(0.925rem + 0.9vw) !important;
	}

	.fs-3 {
	  font-size: calc(0.9rem + 0.6vw) !important;
	}

	.fs-4 {
	  font-size: calc(0.875rem + 0.3vw) !important;
	}

	.fs-5 {
	  font-size: 0.85rem !important;
	}

}

@media (max-width: 767.98px) {
	#go-top {
		padding: 1px 5px;
		bottom: 10px;
	}
}

@media (min-width: 576px) {
	.fs-1 {
	  font-size: calc(0.975rem + 1.5vw) !important;
	}

	.fs-2 {
	  font-size: calc(0.925rem + 0.9vw) !important;
	}

	.fs-3 {
	  font-size: calc(0.9rem + 0.6vw) !important;
	}

	.fs-4 {
	  font-size: calc(0.875rem + 0.3vw) !important;
	}

	.fs-5 {
	  font-size: 0.85rem !important;
	}
}


@media (min-width: 768px) {
	.fs-1 {
	  font-size: calc(1.175rem + 1.5vw) !important;
	}

	.fs-2 {
	  font-size: calc(1.125rem + 0.9vw) !important;
	}

	.fs-3 {
	  font-size: calc(1.1rem + 0.6vw) !important;
	}

	.fs-4 {
	  font-size: calc(1.075rem + 0.3vw) !important;
	}

	.fs-5 {
	  font-size: 1.05rem !important;
	}
}

</style>