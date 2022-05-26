let connected = document.getElementById('connected');
let connectedLogin = document.getElementById('connected-login');

if (connected != null){
    connected.addEventListener('mouseover', () => {
        connectedLogin.style.visibility = 'visible';
        connectedLogin.style.opacity = 1;
    });
    connected.addEventListener('mouseout', () => {
        connectedLogin.style.visibility = 'hidden';
        connectedLogin.style.opacity = 0;
    });
}