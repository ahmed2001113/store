import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
// باقي كود اللارافيل ايكو الي جبناه من موقع البوشر بس هتضيف اليوزر اي دي وهنغير كلمه شانيل لبرايفيت علشان احنا عاملن الشانيل برايفيت مش بابليك
var channel = Echo.private(`App.Models.User.${userID}`);
// المفروض ان احنا نكتب ليسينر ونكتب المسار بتاع الايفينت بس لارافيل فيها اختصار هنكتب اسم النوتيفيكيشن وهو هيجيب الليسينر و الايفينت ديفولت
channel.notification(function(data) {
    console.log(data);
    alert(data.body);
});