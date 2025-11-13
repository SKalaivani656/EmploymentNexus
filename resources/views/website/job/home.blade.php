@extends('components.website.joblayouts.jobapp')
@section('leftsidefilter', true)

@section('title', 'Free job notification Government & Private Jobs in ' . date('Y') . ' | PrepareNext.Com')

@section('description',
    'Search latest job openings in India such as Government, Bank, IT, Software developer,
    Engineering, Railway, Police/Defence, Teaching, Accountant, Medical, Walk-in, and all.',)

@section('keyword',
    'india government job, central government jobs, state government job, bank jobs, it jobs,
    engineering jobs, railway jobs, police jobs, defence jobs, teaching jobs, accountant jobs, medical jobs, walk-in jobs',)

@section('image', url('/logo/logo.jpg'))
@section('headSection')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "PrepareNext.Com",
            "alternateName": "Most Trusted Job Site In India. - Job Portal",
            "url": "https://preparenext.com",
            "logo": "https://preparenext.com/logo/logo.jpg",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "9962408877",
                "contactType": "customer service",
                "contactOption": "HearingImpairedSupported",
                "areaServed": "IN",
                "availableLanguage": ["en", "Tamil", "Hindi", "Malayalam", "Telugu", "Urdu", "Gujarati", "Bengali",
                    "Marathi", "Kannada"
                ]
            },
            "sameAs": [
                "https://www.facebook.com/PrepareNextCom-146278310900843/?ref=page_internal",
                "https://twitter.com/PrepareNext_Com",
                "https://www.instagram.com/preparenext_com/",
                "https://www.linkedin.com/company/preparenext-com/",
                "https://in.pinterest.com/PrepareNext_Com/",
                "https://www.youtube.com/channel/UCK6v0DGUAP752CrI80m3_6w",
                "https://preparenextcom.quora.com/",
                "https://www.reddit.com/user/PrepareNext_Com",
                "https://t.me/PrepareNext_Com",
                "https://preparenext.com/"
            ]
        }, {
            "@context": "http://schema.org",
            "@type": "MobileApplication",
            "applicationCategory": "EducationalApplication",
            "genre": "Job Portal",
            "name": "PrepareNext",
            "description": "PrepareNext offers new job alerts every day, along with daily email job alerts. Our mission is to assist fresh graduates with employment opportunities in all states of India, including government and multinational companies.",
            "operatingSystem": "ANDROID",
            "installUrl": "https://play.google.com/store/apps/details?id=com.prepare.next",
            // "image": "",
            // "screenshot": "",
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "5.0",
                "ratingCount": "10"
            },
            "sourceOrganization": {
                "@context": "http://schema.org",
                "@type": "Organization",
                "name": "8Queens",
                "url": "https://www.8queens.com/"
            },
            "offers": {
                "@type": "Offer",
                "url": "https://play.google.com/store/apps/details?id=com.prepare.next",
                "price": 0,
                "priceCurrency": "USD"
            }
        }

    </script>
@endsection

@section('main-content')

    @livewire('website.job.jobhomepagelistlivewire',
    ['postjob_id' => null,
    'classifyname' => $classifyname,
    'classifytitle' => $data ? $data->name : '',
    'classifyid' => $data ? $data->id : ''])

@endsection

@section('footerSection')
@endsection
