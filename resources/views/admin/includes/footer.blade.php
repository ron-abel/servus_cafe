<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
        <span class="text-muted font-weight-bold mr-2">Copyright &copy; <?php date('Y'); ?> ServusCafe Client Portal by <a href="#">Servus.Cafe</a>. All Rights Reserved. Version: 1.0</span>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark">

        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
<!-- Intercom Snippet -->
<script>
  window.intercomSettings = {
    app_id: "yskhl95g",
    name: "{{$user_details->full_name}}", 							// Admin User Full Name
    email: "{{$user_details->email}}", 								// Admin User Email
	 // when identity verification, used.
    //created_at: "<%= current_user.created_at.to_i %>" 				// Signup date as a Unix timestamp
  };
</script>
<script>
// We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/yskhl95g'
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/yskhl95g';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
