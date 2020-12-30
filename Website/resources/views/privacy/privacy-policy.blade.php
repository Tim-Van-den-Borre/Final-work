<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', '') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 light:bg-gray-900 sm:items-center sm:pt-0">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <h1>Privacy Policy for {{ config('app.name', '') }}</h1>

                <p>At {{ config('app.name', '') }}, accessible from {{ config('app.name', '') }}, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by {{ config('app.name', '') }} and how we use it.</p>

                <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us. Our Privacy Policy was generated with the help of <a href="https://www.gdprprivacynotice.com/"><u>GDPR Privacy Policy Generator</u></a>.</p>

                <h2>General Data Protection Regulation (GDPR)</h2>
                <p>We are a Data Controller of your information.</p>

                <p>{{ config('app.name', '') }} legal basis for collecting and using the personal information described in this Privacy Policy depends on the Personal Information we collect and the specific context in which we collect the information:</p>
                <ul>
                    <li>{{ config('app.name', '') }} needs to perform a contract with you</li>
                    <li>You have given {{ config('app.name', '') }} permission to do so</li>
                    <li>Processing your personal information is in {{ config('app.name', '') }} legitimate interests</li>
                    <li>{{ config('app.name', '') }} needs to comply with the law</li>
                </ul>
                
                <p>{{ config('app.name', '') }} will retain your personal information only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use your information to the extent necessary to comply with our legal obligations, resolve disputes, and enforce our policies.</p>

                <p>If you are a resident of the European Economic Area (EEA), you have certain data protection rights. 
                If you wish to be informed what Personal Information we hold about you and if you want it to be removed from our systems, please contact us using the <b>Contact Information</b> section at the bottom of the page.</p>
                <p>As a user, you have the following data protection rights:</p>
                <ul>
                    <li>The right to access, update or to delete the information we have on you.</li>
                    <li>The right of rectification.</li> 
                    <li>The right to object.</li>
                    <li>The right of restriction.</li>
                    <li>The right to data portability</li>
                    <li>The right to withdraw consent</li>
                </ul>

                <h2>Log Files</h2>

                <p>{{ config('app.name', '') }} follows a standard procedure of using log files. These files log visitors when they visit websites. The information collected by log files include internet protocol (IP) addresses, browser type and the date and time stamp. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site and tracking the amount of users that went on the website.</p>

                <h2>Retention period of personal data / Processing purposes</h2>
                
                <p>Personal data including log files are only kept as long as the user has an account on the website.</p>

                <p>Our processing purposes are to protect user data as long as the user has an account on the website.</p>

                <h2>Cookies and Web Beacons</h2>

                <p>Like any other website, {{ config('app.name', '') }} uses 'cookies'. This website only uses the fully necessary cookies to keep the site functional.</p>

                <p>For more general information on cookies, please read <a href="https://www.cookieconsent.com/what-are-cookies/"><u>what cookies are</u></a>.</p>

                <h2>Third Party Privacy Policies</h2>

                <p>{{ config('app.name', '') }}'s Privacy Policy does not apply to other advertisers or websites.</p>

                <h2>Online Privacy Policy Only</h2>

                <p>Our Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in {{ config('app.name', '') }}. This policy is not applicable to any information collected offline or via channels other than this website.</p>

                <h2>Consent</h2>

                <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                <h2>Contact information</h2>

                <p>In case of any complaint / questions, you can contact the owner of this website by email.</p>

                <ul>
                    <li>Owner: Tim Van den Borre</li>
                    <li>Email: tim.vandenborre@student.ehb.be</li>
                </ul>
            </div>
        </div>
    </body>
</html>
