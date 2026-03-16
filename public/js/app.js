import './bootstrap';
// ملف JavaScript مبدئي – يمكن إضافة تفاعلات مستقبلية هنا
document.addEventListener('DOMContentLoaded', function() {
    console.log('الصفحة جاهزة - نظام إدارة السوبر ماركت');
    
    // مثال: إضافة سلاسة للتمرير عند النقر على الأزرار (اختياري)
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // يمكن إضافة سلوك مخصص هنا
        });
    });
});