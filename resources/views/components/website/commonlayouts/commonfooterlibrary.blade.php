<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

<script>
    function sharemodal(tilte, slug) {

        //  document.getElementById("share_gmail").innerHTML = slug;


        var share_modal_body = `<a class="text-decoration-none m-2 d-block d-sm-none" target="_blank"
                        href="whatsapp://send?text=` + slug + `"
                        data-action="share/whatsapp/share">
                        <i class="bi bi-whatsapp m-1" style="font-size: 2.5rem; color: #54b641;"></i>
                    </a>
                    <a class="text-decoration-none m-2 d-none d-md-block d-lg-block" target="_blank"
                        href="https://web.whatsapp.com/send?text=` + slug + `"
                        data-action="share/whatsapp/share">
                        <i class="bi bi-whatsapp m-1" style="font-size: 2.5rem; color: #54b641;"></i>
                    </a>
                    <a class="text-decoration-none m-2" target="_blank"
                        href="http://www.facebook.com/share.php?u=` + slug + `">
                        <i class="bi bi-facebook m-1" style="font-size: 2.5rem; color: #3b5998;"></i>
                    </a>
                    <a class="text-decoration-none m-2" target="_blank"
                        href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://twitter.com/share?url=` +
            slug + `">
                        <i class="bi bi-linkedin m-1" style="font-size: 2.5rem; color: #0082ca;"></i>
                    </a>
                    <a class="text-decoration-none m-2" target="_blank"
                        href="https://telegram.me/share/url?url=` + slug + `">
                        <i class="bi bi-telegram m-1" style="font-size: 2.5rem; color: #3996c8;"></i>
                    </a>
                    <a class="text-decoration-none m-2" target="_blank"
                        href="https://twitter.com/share?url=` + slug +
            `">
                        <i class="bi bi-twitter m-1" style="font-size: 2.5rem; color: #55acee;"></i>
                    </a>
                    <a class="text-decoration-none m-2" target="_blank"
                        href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=&su=PrepareNext.Com&body=` +
            slug + `&ui=2&tf=1&pli=1">
                        <i class="bi bi-envelope-fill m-1" style="font-size: 2.5rem; color: red;"></i>
                    </a>`;

        document.getElementById("share_modal_body").innerHTML = share_modal_body;
        document.getElementById("share_modal_value").value = slug;
    }

</script>

<script>
    function copy_link() {
        /* Get the text field */
        var copyText = document.getElementById("share_modal_value");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        /* Alert the copied text */
        //  alert("Copied the text: " + copyText.value);
    }

</script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

</script>


<style>
    .bd-footer a {
        color: #495057;
        text-decoration: none;
    }

    .bd-footer a:hover {
        color: #0d6efd;
        text-decoration: underline;
    }

    .hoverlink a:hover {
        color: #0d6efd !important;
    }

    .textwhite:hover {
        color: white !important;
    }

</style>

<style>
    @media (min-width: 1400px) {
        .underline {
            /* font-size: 24px; */
            position: relative;
        }

        .underline::after {
            background-color: #efefef;
            bottom: 5px;
            content: '';
            display: block;
            height: 2px;
            left: 50%;
            position: absolute;
            transform: translate(-50%, 0);
            width: 50px;
        }


        .underline_two {
            /* font-size: 24px; */
            position: relative;
        }

        .underline_two::after {
            background-color: #00c5d0;
            bottom: 5px;
            content: '';
            display: block;
            height: 2px;
            left: 50%;
            position: absolute;
            transform: translate(-50%, 0);
            width: 50px;
        }
    }

</style>


<script>
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

</script>


@section('footerSection')
@show



<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-76229821-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-76229821-1');

</script>
