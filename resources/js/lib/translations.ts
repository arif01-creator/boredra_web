export const locales = ['en', 'bn'] as const;

export type Locale = (typeof locales)[number];

export const localeLabels: Record<Locale, string> = {
    en: 'EN',
    bn: 'বাং',
};

const en = {
    'nav.home': 'Home',
    'nav.about': 'About',
    'nav.products': 'Products',
    'nav.quality': 'Quality',
    'nav.globalReach': 'Global Reach',
    'nav.contact': 'Contact',
    'nav.companyProfile': 'Company Profile',
    'nav.inquire': 'Inquire',

    'footer.navigate': 'Navigate',
    'footer.contact': 'Contact',
    'footer.legal': 'Legal',
    'footer.privacy': 'Privacy Policy',
    'footer.terms': 'Terms',
    'footer.description':
        'A registered exporting company based in Dakshinkhan, Dhaka, Bangladesh, supplying human hair, dressed hair, animal hair and synthetic materials to the global wig and hair-product industry.',
    'footer.rights': 'All Rights Reserved.',

    'hero.label1': 'Borendra International',
    'hero.label2': 'Premium Export & Materials',
    'hero.heading1': 'Exceptional Materials.',
    'hero.heading2': 'Global Possibilities.',
    'hero.body':
        'Borendra International is a Bangladesh-based export company specializing in human hair, dressed hair, animal hair and synthetic materials for the global wig and hair industry.',
    'hero.exploreProducts': 'Explore Our Products',
    'hero.scrollToExplore': 'Scroll to Explore',
    'hero.placeholderLabel': 'Add hero photography via Admin → Media',
    'hero.altText': 'Borendra International — premium hair and materials export',

    'common.explore': 'Explore',
    'common.discoverCompany': 'Discover Borendra International',
    'common.getInTouch': 'GET IN TOUCH',
    'common.sendInquiry': 'Send Inquiry',
    'common.contactUs': 'Contact Us',
    'common.dhakaBangladesh': 'Dhaka, Bangladesh',
    'common.bangladesh': 'Bangladesh',
    'common.emptyDestinations': 'Export destinations will appear here as they are confirmed and added via Admin.',

    'quality.label': 'Quality Is A Process',

    'globalMap.ariaLabel': 'Map of export destinations from Bangladesh',

    'placeholder.craftsmanship': 'Borendra International craftsmanship',
    'placeholder.operations': 'Borendra International operations',

    'form.name': 'Name *',
    'form.company': 'Company',
    'form.email': 'Email *',
    'form.phone': 'Phone',
    'form.country': 'Country',
    'form.productInterest': 'Product Interest',
    'form.selectMaterial': 'Select a material',
    'form.quantity': 'Quantity / Requirement',
    'form.message': 'Message *',
    'form.sendInquiry': 'Send Inquiry →',
    'form.sending': 'Sending…',
    'form.thankYouTitle': 'Thank you — your inquiry has been received.',
    'form.thankYouBody': 'Our team will respond as soon as possible.',

    'home.whoWeAre': 'WHO WE ARE',
    'home.basedIn': 'Based In',
    'home.focus': 'Focus',
    'home.focusValue': 'Hair & Wig Materials',
    'home.market': 'Market',
    'home.marketValue': 'International B2B',
    'home.aboutLabel': 'ABOUT',
    'home.materialsLabel': 'OUR MATERIALS',
    'home.materialsHeading': 'Materials chosen\nfor their character.',
    'home.globalReachLabel': 'FROM BANGLADESH TO GLOBAL MARKETS',
    'home.globalReachHeading': 'From Bangladesh\nto Global Markets.',
    'home.responsibleLabel': 'RESPONSIBLE',
    'home.ctaHeading': "Let's Build\na Global Connection.",
    'home.ctaDescription': 'Share your requirements and our team will respond with the information you need.',

    'about.label': 'About Borendra International',
    'about.bullet1': 'Registered exporting company based in Dakshinkhan, Dhaka, Bangladesh',
    'about.bullet2': 'International business focus across the wig and hair-product industry',
    'about.bullet3': 'Material sourcing across human hair, dressed hair, animal hair and synthetic materials',
    'about.bullet4': 'Direct export support for international partners',
    'about.ctaHeading': 'Discover our\nfull company profile.',

    'products.label': 'Our Materials',
    'products.heading': 'Materials chosen\nfor their character.',
    'products.breadcrumb': 'Products',
    'products.overview': 'Overview',
    'products.applications': 'Applications',
    'products.specifications': 'Specifications',
    'products.relatedMaterials': 'Related Materials',
    'products.ctaDescription': 'Share your requirements and our team will confirm availability and specifications.',
    'products.interestedIn': 'Interested in',

    'qualityPage.label': 'Quality & Process',
    'qualityPage.heading1': 'Quality is',
    'qualityPage.heading2': 'a process.',
    'qualityPage.ctaHeading': 'Questions about\nour process?',

    'globalReachPage.label': 'Global Reach',
    'globalReachPage.heading1': 'From Bangladesh',
    'globalReachPage.heading2': 'to Global Markets.',
    'globalReachPage.ctaHeading': 'Looking to\nsource from Bangladesh?',

    'companyProfile.label': 'Company Profile',
    'companyProfile.legalName': 'Legal Name',
    'companyProfile.businessType': 'Business Type',
    'companyProfile.address': 'Address',
    'companyProfile.contact': 'Contact',
    'companyProfile.download': 'Download Company Profile',
    'companyProfile.defaultBusinessType': 'Registered Exporting Company',

    'contactPage.label': 'Get In Touch',
    'contactPage.heading1': "Let's build",
    'contactPage.heading2': 'a global connection.',
    'contactPage.body': 'Share your requirements and our team will respond with the information you need.',

    'legal.label': 'Legal',
    'legal.privacyTitle': 'Privacy Policy',
    'legal.termsTitle': 'Terms of Service',
};

export type TranslationKey = keyof typeof en;

const bn: Record<TranslationKey, string> = {
    'nav.home': 'হোম',
    'nav.about': 'আমাদের সম্পর্কে',
    'nav.products': 'পণ্যসমূহ',
    'nav.quality': 'মান',
    'nav.globalReach': 'বৈশ্বিক নাগাল',
    'nav.contact': 'যোগাযোগ',
    'nav.companyProfile': 'কোম্পানি প্রোফাইল',
    'nav.inquire': 'যোগাযোগ করুন',

    'footer.navigate': 'নেভিগেশন',
    'footer.contact': 'যোগাযোগ',
    'footer.legal': 'আইনি',
    'footer.privacy': 'গোপনীয়তা নীতি',
    'footer.terms': 'শর্তাবলী',
    'footer.description':
        'বোরেন্দ্র ইন্টারন্যাশনাল ঢাকার দক্ষিণখানে অবস্থিত একটি নিবন্ধিত রপ্তানিকারক প্রতিষ্ঠান, যা বৈশ্বিক উইগ ও চুল-পণ্য শিল্পের জন্য মানুষের চুল, ড্রেসড হেয়ার, পশুর লোম এবং সিন্থেটিক উপকরণ সরবরাহ করে।',
    'footer.rights': 'সর্বস্বত্ব সংরক্ষিত।',

    'hero.label1': 'বোরেন্দ্র ইন্টারন্যাশনাল',
    'hero.label2': 'প্রিমিয়াম রপ্তানি ও উপকরণ',
    'hero.heading1': 'অনন্য উপকরণ।',
    'hero.heading2': 'বৈশ্বিক সম্ভাবনা।',
    'hero.body':
        'বোরেন্দ্র ইন্টারন্যাশনাল বাংলাদেশ-ভিত্তিক একটি রপ্তানিকারক প্রতিষ্ঠান, যা বৈশ্বিক উইগ ও চুল শিল্পের জন্য মানুষের চুল, ড্রেসড হেয়ার, পশুর লোম এবং সিন্থেটিক উপকরণ নিয়ে কাজ করে।',
    'hero.exploreProducts': 'আমাদের পণ্য দেখুন',
    'hero.scrollToExplore': 'জানতে স্ক্রল করুন',
    'hero.placeholderLabel': 'অ্যাডমিন → মিডিয়া থেকে হিরো ছবি যুক্ত করুন',
    'hero.altText': 'বোরেন্দ্র ইন্টারন্যাশনাল — প্রিমিয়াম চুল ও উপকরণ রপ্তানি',

    'common.explore': 'দেখুন',
    'common.discoverCompany': 'বোরেন্দ্র ইন্টারন্যাশনাল সম্পর্কে জানুন',
    'common.getInTouch': 'যোগাযোগ করুন',
    'common.sendInquiry': 'অনুসন্ধান পাঠান',
    'common.contactUs': 'যোগাযোগ করুন',
    'common.dhakaBangladesh': 'ঢাকা, বাংলাদেশ',
    'common.bangladesh': 'বাংলাদেশ',
    'common.emptyDestinations': 'যাচাইকৃত রপ্তানি গন্তব্যগুলো অ্যাডমিন থেকে যুক্ত হওয়ার পর এখানে দেখা যাবে।',

    'quality.label': 'মান একটি প্রক্রিয়া',

    'globalMap.ariaLabel': 'বাংলাদেশ থেকে রপ্তানি গন্তব্যের মানচিত্র',

    'placeholder.craftsmanship': 'বোরেন্দ্র ইন্টারন্যাশনালের কারুকার্য',
    'placeholder.operations': 'বোরেন্দ্র ইন্টারন্যাশনালের কার্যক্রম',

    'form.name': 'নাম *',
    'form.company': 'কোম্পানি',
    'form.email': 'ইমেইল *',
    'form.phone': 'ফোন',
    'form.country': 'দেশ',
    'form.productInterest': 'আগ্রহের পণ্য',
    'form.selectMaterial': 'একটি উপকরণ নির্বাচন করুন',
    'form.quantity': 'পরিমাণ / প্রয়োজন',
    'form.message': 'বার্তা *',
    'form.sendInquiry': 'অনুসন্ধান পাঠান →',
    'form.sending': 'পাঠানো হচ্ছে…',
    'form.thankYouTitle': 'ধন্যবাদ — আপনার অনুসন্ধান গ্রহণ করা হয়েছে।',
    'form.thankYouBody': 'আমাদের দল যত দ্রুত সম্ভব সাড়া দেবে।',

    'home.whoWeAre': 'আমরা কারা',
    'home.basedIn': 'অবস্থান',
    'home.focus': 'কেন্দ্রবিন্দু',
    'home.focusValue': 'চুল ও উইগ উপকরণ',
    'home.market': 'বাজার',
    'home.marketValue': 'আন্তর্জাতিক বি২বি',
    'home.aboutLabel': 'পরিচিতি',
    'home.materialsLabel': 'আমাদের উপকরণ',
    'home.materialsHeading': 'বৈশিষ্ট্যের ভিত্তিতে\nনির্বাচিত উপকরণ।',
    'home.globalReachLabel': 'বাংলাদেশ থেকে বৈশ্বিক বাজারে',
    'home.globalReachHeading': 'বাংলাদেশ থেকে\nবৈশ্বিক বাজারে।',
    'home.responsibleLabel': 'দায়িত্বশীলতা',
    'home.ctaHeading': 'আসুন গড়ি\nএকটি বৈশ্বিক সংযোগ।',
    'home.ctaDescription': 'আপনার প্রয়োজনীয়তা জানান, আমাদের দল প্রয়োজনীয় তথ্য নিয়ে সাড়া দেবে।',

    'about.label': 'বোরেন্দ্র ইন্টারন্যাশনাল সম্পর্কে',
    'about.bullet1': 'ঢাকার দক্ষিণখানে অবস্থিত একটি নিবন্ধিত রপ্তানিকারক প্রতিষ্ঠান',
    'about.bullet2': 'উইগ ও চুল-পণ্য শিল্পে আন্তর্জাতিক ব্যবসায়িক কেন্দ্রবিন্দু',
    'about.bullet3': 'মানুষের চুল, ড্রেসড হেয়ার, পশুর লোম ও সিন্থেটিক উপকরণ সংগ্রহ',
    'about.bullet4': 'আন্তর্জাতিক অংশীদারদের জন্য সরাসরি রপ্তানি সহায়তা',
    'about.ctaHeading': 'আমাদের সম্পূর্ণ\nকোম্পানি প্রোফাইল দেখুন।',

    'products.label': 'আমাদের উপকরণ',
    'products.heading': 'বৈশিষ্ট্যের ভিত্তিতে\nনির্বাচিত উপকরণ।',
    'products.breadcrumb': 'পণ্যসমূহ',
    'products.overview': 'পরিচিতি',
    'products.applications': 'ব্যবহারক্ষেত্র',
    'products.specifications': 'বৈশিষ্ট্য',
    'products.relatedMaterials': 'সম্পর্কিত উপকরণ',
    'products.ctaDescription': 'আপনার প্রয়োজনীয়তা জানান, আমাদের দল প্রাপ্যতা ও বৈশিষ্ট্য নিশ্চিত করবে।',
    'products.interestedIn': 'আগ্রহী',

    'qualityPage.label': 'মান ও প্রক্রিয়া',
    'qualityPage.heading1': 'মান একটি',
    'qualityPage.heading2': 'প্রক্রিয়া।',
    'qualityPage.ctaHeading': 'আমাদের প্রক্রিয়া নিয়ে\nপ্রশ্ন আছে?',

    'globalReachPage.label': 'বৈশ্বিক নাগাল',
    'globalReachPage.heading1': 'বাংলাদেশ থেকে',
    'globalReachPage.heading2': 'বৈশ্বিক বাজারে।',
    'globalReachPage.ctaHeading': 'বাংলাদেশ থেকে সংগ্রহ\nকরতে চান?',

    'companyProfile.label': 'কোম্পানি প্রোফাইল',
    'companyProfile.legalName': 'আইনি নাম',
    'companyProfile.businessType': 'ব্যবসার ধরন',
    'companyProfile.address': 'ঠিকানা',
    'companyProfile.contact': 'যোগাযোগ',
    'companyProfile.download': 'কোম্পানি প্রোফাইল ডাউনলোড করুন',
    'companyProfile.defaultBusinessType': 'নিবন্ধিত রপ্তানিকারক প্রতিষ্ঠান',

    'contactPage.label': 'যোগাযোগ করুন',
    'contactPage.heading1': 'আসুন গড়ি',
    'contactPage.heading2': 'একটি বৈশ্বিক সংযোগ।',
    'contactPage.body': 'আপনার প্রয়োজনীয়তা জানান, আমাদের দল প্রয়োজনীয় তথ্য নিয়ে সাড়া দেবে।',

    'legal.label': 'আইনি',
    'legal.privacyTitle': 'গোপনীয়তা নীতি',
    'legal.termsTitle': 'শর্তাবলী',
};

export const dictionaries: Record<Locale, Record<TranslationKey, string>> = { en, bn };
