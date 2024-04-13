function showNotification(message){
    console.log("showNotification function called with message:", message);
    const notificationDiv = document.createElement('div');
    notificationDiv.classList.add('notification');
    notificationDiv.innerHTML = `<span class="message">${message}</span>`;
    document.body.appendChild(notificationDiv);

    setTimeout(function () {
        notificationDiv.classList.add('hidden');
        setTimeout(function () {
            notificationDiv.remove();
        }, 500);
    }, 3000);
}