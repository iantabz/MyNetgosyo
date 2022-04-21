export function debounce (fn, delay) {
    var timeoutID = null
    return function () {
      clearTimeout(timeoutID)
      var args = arguments
      var that = this
      timeoutID = setTimeout(function () {
        fn.apply(that, args)
      }, delay)
    }
  }

export function showNotif(title, options, site_url) {
    if (!('Notification' in window)) {
        console.log('Error:','Notification API not supported!');
        return;
    } else {
        if(Notification.permission !== 'granted') {
            Notification.requestPermission();
        } else if (Notification.permission === 'granted') {
            try {
                let notification = new Notification(title, options);
                notification.onclick = function(event){
                event.preventDefault();
                  window.focus();
                  window.location.href = `${site_url}transactions`;
                };
            } catch (err) {
                console.log('Notification API error: ' + err);
            }
        }
    }
}