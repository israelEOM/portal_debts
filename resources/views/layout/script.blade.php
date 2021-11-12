<!-- jquery -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- popper -->
<script src="{{ url('assets/plugins/popper/popper.js') }}"></script>
<!-- bootstrap -->
<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
 <!-- mask -->
<script src="{{ url('assets/plugins/mask/jquery.mask.js') }}"></script>
<!-- jquery -->
<script src="{{ url('assets/plugins/easing/easing.js') }}"></script>
<!-- angular -->
<script src="{{ url('assets/plugins/angular/angular.min.js') }}"></script>
<!-- angular cookie -->
<script src="{{ url('assets/plugins/angular/angular.cookie.js') }}"></script>
<!-- app-angular -->
<script src="{{ url('assets/painel/js/angular/app.js') }}"></script>

@stack('scripts')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162464147-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-162464147-1');

</script>
<!-- Global site tag (gtag.js) - Google Ads: 677294252 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-677294252"></script>
<script>
     window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-677294252');
</script>
<!-- Event snippet for Visualização do Portal conversion page -->
<script>
    gtag('event', 'conversion', {'send_to': 'AW-677294252/6IjxCIfI38sBEKzh-sIC'});
</script>