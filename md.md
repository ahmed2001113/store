<!-- 
8.1
هنعمل علاقه بين الموديلز علشان نقدر نستعلم عن معلومات من جدول بستخدام جدول اخر
الكاتيجوري و الموديلز
8.2
لو فيه جدول فيه اكثر من 30 كولم يستحسن تقسمه علي جدولين و تخلي بينهم علاقه 1الي1
هنعمل جدول اسمه بروفايل علشان يشيل باقي بيانات اليوزر و هنعمل علاقه 1الي1 بين الجدول ده وجدول اليوزر و عملنا جدولين علشان عمليه تسجيل الدخول تكون اسرع و نتاكد من الايميل و الباسورد الي في جدول اليوزر بس 

symphony intl دي مكتبه هنستخدمها علشان توفر علينا اللغات و العملات 
بنحملها و بستخدمها في الكنترولار
بس هلازم تخش علي برنامج الاكز امب و تدوس كونفيج بتاعت البي ات شبي و تختار بي اتش بي اني تبحث عن intl وتشيل ;الي جمبها بعد كده اقفل البرنامج و افتحه
8.3
many to many
هنعمل جدول اسمه تاج علاشن يكون لكل بروداكت تاج او رمز معين يدل عليه وهنعمل جدول اسمه بروداكت تاج وخلي بالك من الاسماء
فيه مكتبه اسمها tagily بنستخدمها علشان نعرض التاج بطريقه احسن وليها لنكيت ضيفناها في صفحه فيو-داشبورد-بروداكت-فورم 
بس احنا نزلنا الكود و خزناه عندنا علشان نخفف عمليه التحميل
9.1
استخدمنا داشبورد للفرونت و عملنا كمبوننت اسمه فرونت لاي اوت هتلاقيه في الاب-فيو هنعرض بيه بدل نظام الوراثة
فيه حاجه اسمها هيلبرز دي بنستخدمها علشان تساعدنا في حاجه معينه زي مثلا العملات هنكتبها في هيلبر و هنستدعيها في الفرونت و علشان نغير كل العملات في الموقع هنغير في الهيلبر بس و بتعمل نيوفايل بنفسك
9.2
شرحنا الميديل وير و هنعمل ميديلوير اسمها شيك يوزر تايب علشان نحدد الي سجل يوزر و لا ادمن
هتلاقي فايل اسمه شيك يوزر تايب اتعمل في فولدر الاميديلوير
عملنا ميديلوير اسمه ابديتيوزرلاستاكتيف علشان نجيب اخر وقت اليوزر كان فاتح فيه
ولازم تعرف الميديلوير في صفحه الكيرنال و لو هتعمل ايلياس برضه في نفس الصفحه
10.1
هنخزن المنتجات في السله سواء اليوزر عامل ايميل او لا
هنعمل الكارت بنظام الديزاين باترن علشان نعمله مره واحده وننادي عليه في اكثر من كنترولار
عملنا الريبوستري و الانتر فيس في نفس الصفحه ونادينا عليهم في الكنترولار بدون ما نربطهم
فيه حاجه اسمها سيرفر كونتينر وبتستخدمه علشان نخزن اسم الريبوستري في فانكشن ولما ننادي عليه في الكنترولار هنكتب اسم الفانكشن بس بدل ما نكتب اسم الريبوستري كامل 
و علشان نعمله بنكتب 
php artisan make:provider --- وخلي بالك من الاسم هتلاقي فايل اتعمل في فولدر البروفايدرز
10.2 
كملنا علي الكارد بس عملنا تحسينات في الكود
facedadds بنستخدمها علشان نجيب البيانات اللي في الكوكي و نعرضها في كمبوننت الكادر الي في الناف بار بنعمل فولدر في الاب بنفسنا بعد كده هتعمل كمبوننت للكادر ده وتنادي علي الفبساد

هنخلي القيمه بتاعت الكميه تتعدل تلقائي اول لما تعدلها في الموقع و علشان نعمل كده هنستخدم اجاكس في الكارد بتاع االفرونت و هندي للانبوت كلاس و اتريبيوت داتا
هنبعت الي دي بتاع البروداكت و هنعمل فايل جدبد ف فولدر الجافاسكريبت الي في الريسورس
بسلازم تعملبوش للجيكويري و للتوكين من فايل الفرونت الي فيه الانبوت بعد كده بتخش علي فايل webpack.mix.js علشان تربط بتاع الجافا اسكريبت في البابليك
وبعد ما تخلص لازم تعمل nom run prod
11.1
هنعمل موديل وجدول للاوردر
11.2
هنعمل ايفينت وليسينر علشان نفضي السله بعد الاوردر و نعمل نوتيفيكشن
بتكتب اسم الايفينت في الكنترولار بعد كده بتعمل ليسينر
php artisan make:listener --
بعد كده هتخش علي فايل البروفايدر هتلاقي فايل للايفينتس اربط الايفينت والليسينر فيه
12.1
هنعمل نوتيفيكيشن 
php artisan make:notification هتلاقي فولدر في الاب اسمه نوتيفيكيشن
بس فيه اعدادات في فايل الانف لام تعملها
فيه موقع اسمه ميل تراب بتعمل عليه تيست للرسائل
بتعمل ايميل بعد كده بتختار ايميل تيستينج انبوكسيس و تختار لارافيل وتاخد اعدادات فايل الانف و تكتبها
بعد كده هنعمل ليسينر لارسال النوتيفيكيشن 
اي موديل هتبعتله نوتيفيكيشن لازم يكون عامل يوز لحاجه اسمها Notifiable هتلاقيها في موديل اليوزر
الموقع مش شغال
لو عايز تغير في شكل الرساله الي بتظهر لليوزر لازم تكتب
php artisan vendor:publish --tag=laravel-notifications
php artisan vendor:publish --tag=laravel-mail
و هتغير في الاستايل بتاع الفايلات دي
12.2
php artisan notification:table هنكتب كده علشان نعمل جدول نوتيفيكيشن جاهز
هنعمل كمبوننت علشان نبعت الرسائل للادمن ونعرضها فيه
النوتيفيكيشن مش شغاله لانه كاتب كود معين في الليسينربتاع الرسائل لما نوصله هنفهم
خلينا الدمن تظهرله الرسائل وضيفنا الاي دي بتاع الرساله علشان نعرف ان الادمن ضغط عليها علشان يقرئها و هنعمل ميديلويير علشان لو استقبلنا اي دي نجيب اليوزر و نخلي الرساله مقروئه 
و متنساش تضيف الميديلوير في الكيرنال
12.3
هنستخدم البوشر علشان نعمل ريل تايم نوتيفيكيشن
بس هنعمل الاعدادات دي في فايل الانف
BROADCAST_DRIVER=pusher
بعد كده هتخش علي الكونفيج-اب و تشيل الكومنت الي محطوط علي الكود ده App\Providers\BroadcastServiceProvider::class,
هنعمل ايميل بوشر جديد و هنستخدم في الفرونت جيكويري و الباك لارافيل
هنحمل البوشر من الموقع
و هنضيف الاعدادات دي وهنجيبهم من الاب كي في السايدبار
app_id = "1740286"
key = "bf7bae694e3b06bacd7a"
secret = "e7f32edc71a464851169"
cluster = "ap3"
وهتضيف دول في الانف
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
بعد كده هتكمل في النوتيفيكيشن الي عملناه باسم البرودكاست و مش هنعمل اكثر من كده
بس علشان تختبر الرسائل هتدوس علي ديباج كونسول من السايدبار
بعد كده من نفس الموقع هنشتغل باللارافيل ايكو هنحملها بعد كده هتلاقي كود جافااسكريبت في الموقع
هتخش علي الكود عندك علي فايل ريسورس بوتستراب جي اس هتلاقي جزء من الكود ده والباقي هنكتبه في فايل الاب الب مع فايل البوتستراب
بعد كده هتعمل npm run prod
وهتضيف لينك مسار الفايل ده في الفرونت بتاع الداشبورد(فيو-لاياوت-داشبوردلاياوت) وهتبعتله اليوزر اي دي في نفس الفايل
13.1
فيه حاجه اسنها لارافيلورتي فاي دي زي البريز بس دي بتعمل الكنترولار و الراوت و انا بعمل الفيو 
composer require laravel\fortify
بعد كده هتعمل بابليش هتلاقي فايل في الاب اسمه اكشن فيه الميثود بتاعت الفورتيفاي  
وهتلاقي بروفايدر اتعمل ليها بس لازم تربطها في فايل الكونفيج-اب بعد كده هتعمل ميجريت لانه هينشأ جدول للتسجيل بنفسه علشان يضيف كولم علي جدول اليوزر
بس لازم تلغي راوت البريز لان الفورتي بتعمل نفس الوظيفة 
فيه فايل اسمه فورتيفاي في الكونفيج خاص بالاعدادات ومش هنعدل فيه اي حاجه بسهنعدل في البروفايدر   
13.2
هنعمل موديل وجدول وجارديد للادمن بس هنخلي موديل الادمن اكستند من يوزر علشان ياخد نفس الفانكشن 
هنضيف كود باسورد خاص بالادمن في فايل الكونفيج -اوث الي بنضيف فيه الجارديد 
هنعدل في فايل البروفايدر علشان لما الادمن هو الي يجي يسجل يعدل كل حاجه لااعدادات الادمن 
13.3
ازاي تسجل دخول برقم التليفون او اللاسم عملناها في صفحهالبروفايدر
هنعمل فايل في الاب-اكشن بنفسنا و هنكتب الكود (اوثانتيكيتد يوزر)  
13.4
two-factor دي معناها ان اليوزر بيبعت كود تأكيد تسجيل الدخول 
هنخليها ميزه الي حابب يفعلها يفعلها هنعمل فايل اسمخ توفاكتور اينابول-اوث-فرونت-فيو 
هنعمل كنترولار و راوت بس لازم في موديل اليوزر تعمل اكستند للتوفاكتور 
بعد كده هنجيب فايل كونفيرم باسورد من فايل فيو-اوث علشان فيه ايرور هيطلع علشان مينفعش اعمل نوفاكتور من غير كونفيرم باسورد 
بعد كده عدلنا الفرونت علشان امل يضغط تفعيل هيظهرله كيواركود هيعمله اسكان هيديله رقم يكتبه اول لما يسجل 
وعملنا ريكوفيري كود علشا لو معرفش يجيب الكيوار كود يسجل باريكوفيري كود 
14.1
هنعمل كنترولار من نوع --api 
و هنعمل فانكشن في موديل البروداكت
بعد كده هنستخدم بوست مان ممكن تعمل دوكومنتيشن للابي اي و ممكن تشاركه  
بتعمل نيوكوليكشن و بتكتب ليها اسم بعد كده بتعمل نيو ريكويست  
اختار هيدر من النافبار و ضيف اكسيبت جيسون علشان يعرض الناتج جيسون 
وبتكتب اللينك كده http://localhost:8000/api/products 
وممكن تختار من النافبار برامس وتعرف فيها الابي اي بتاعك 
لوعايز تخفي حاجه من الابي اي هتدخل علي الموديل و تعمل فانكشن هيدين وتكتب فيها الي عايز تخفيه 
 
علشان نبعت بيانات هنختار باديي و فورم داتا 
وعلشان نعدل هنختار رقم 3 و هنختار put و هنكتب رقم البروداكت
14.2
هنعمل كستميزيشن يعني تعديل للبيانات الي هترجع هنغير اسماء البيانات الي في الابي اي
هنعمل حاجه اسمها ابي اي ريسورس php artisan make:resource ProductResource
بس لما بنستخدم الريسورس البيانات بترجع كلها في اراي اسمه داتا لو انا مش عايز ده يحصل بكتب فانكشن في صفحه اب سيرفيس بروفايدر بس ده هيطبقه علي كل الابي اي ولوحبيت تستثني اي فانكشن من الكود ده ممكن تزود اراي الداتا في الريسورس الي عملته 
14.3
علشان نعمل اوثنتيكيشن للابي اي لازم نعمل توكين علشان في الموقع بنستخدم السيشن والكوكيز والابي اي مفيهوش الكلام ده فا بنعمل توكين ولارافيل عامله مكتبتين للتوكين باسبورت وسانتيكم
في العادي بنستخدم سانتيكم و الباسبورت لو عايز اعمل حاجه زي ايميل جوجل و اقدر استخدمه في عمل تسجيل دخول لاكثر من موقع و سانتيكم بنحملها الا لو نستخدم لارافيل 9 او 10 لانها موجوده تلقائي وليها جدول في الداتابيز
في فولدر الكونفيج فيه فايل للسانتيكم هنحدد فيه الجارديد الي هنستخدمه وممكن تحدد التوكين بتنتهي بعد امتي في فانكشن اكسبيراشن
هنعمل كنترولار علشان يكريت توكين لاي حد يعمل لوجين وهنرجع التوكين في الابي اي
علشان تجرب عمليه الحذف نت البوست مان لازم تبعتله التوكين علشان يعرف انك مسجل فا هتختار كلمه اوثوريزيشن من الناف بار و تختار بيرر توكين وتكتب التوكين

فيه حاجه اسمها ايبي اي توكين و دي بنستخدمها علشان نحمي الريكويست يعني مينفعش اي حد من اي مكان يشوف المنتجات الي عندنا مثلا من غير ما يكون مستخدم الموقع فا هنعرف api_token في فايلا الانف و هنكتب اي باسورد احنا عايزينه و هنعرف القيمه في فايل الكونفيج-اب
بعد كده هنعمل ميديلوير شيك ايبي اي توكين بعد كده هتعرف الميديلوير دي في الكيرنال
15.1
احنا هنستخدم اي بياي خارجي علشان نجيب منه العملات و يبقي ظاهر غندنا في النافبار لست بختار منها العمله بس قبل كل ده هنعمل فولدر في فايل الاب اسمه سيرفيس و هنشرح هناك كل حاجه
هنعمل كنترولار كرانسي كونفيرت لتغير العمله
اسمع الفيديو ثاني
15.2
عمل الترجمه باللوكاليزيشن و شرح الترجمه بالجيسون بدل الصفح في فايل الترجمه
16.1
اوثوريزيشن معناها صلاحيات يعني الادمن ممكن يعمل ايه والسوبر ادمن ممكن يعمل ايه فيه باكيدج للاوثوريزيشن بس هنتعلم نعملها الاول بادينا
بنستخدم حاجه اسمها البوبابات في صفحه البروفايدر-اوث سيرفربوفايدر
بس قبلها بنعرف الصلاحيه في الكنترولار في الفانكشن الي عايزين نحدد فيها الصلاحيه
وعملناها ب 3 طرق مختلفه في كنترولار الكاتيجوري
و في الفرونت هنخفي زر حذف الكاتيجوري  لو الشخص ملوش صلاحيات لحذفه 
في فايل الكونفيج-ناف احنا عملناه و عملنا فيه صلاحيات ايه الي يظهر لو ادمن عادي و لو سوبر ادمن
و عملنا اف كونديشن في الكمبوننت الخاص بالناف في صفحه الاب
علشان نحدد الصلاحيات لكل يوزر هنعمل موديل وجدول اسمه رول  و رول ابيليتي علشان نخزن فيه الصلاحيات
30








 -->