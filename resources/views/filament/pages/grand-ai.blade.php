<x-filament-panels::page>
<style>
.fi-header.flex{
    display: none;
}

/* write all css here */
.chat-section {
    display: flex;
    justify-content: center;
    align-items: center;
}
.chat-container {
    display: flex;
    width: 100%;
    max-width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.chat-sidebar {
    width: 300px;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.1);
    border-right: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px 0 0 10px;
    overflow-y: auto;
}
.chat-sidebar-toggle {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.chat-sidebar-toggle button {
    background-color: transparent;
    border: none;
    cursor: pointer;
}
.chat-sidebar-new-session {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    justify-content: space-between;
    padding: 0 10px;
}
.chat-sidebar-new-session button.btn-ns {
    background-color: #c9985e;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
}
.chat-sidebar-sessions {
    padding: 10px;
}
.chat-sidebar-sessions-header h4 {
    margin: 0;
    padding: 10px 0;
    font-size: 16px;
    font-weight: 600;
}
.chat-sidebar-sessions-list {
    padding: 10px 0px;
}
.chat-sidebar-sessions-list-item {
    padding: 10px;
    border-radius: 10px;
    cursor: pointer;
}
.chat-sidebar-sessions-list-item:hover {
    background-color: rgba(255,255,255,0.1);
}
.chat-sidebar-sessions-list-item p {
    margin: 0;
    font-size: 14px;
}
.chat-box {
    width: 100%;
    height: 100%;
    border-radius: 0 10px 10px 0;
}
.chat-box-header {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    justify-content: space-between;
    padding: 0 10px;
}
.chat-box-header-text h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}
.chat-box-body {
    padding: 10px;
    height: 500px;
    overflow-y: auto;
}
.chat-box-body-text {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    padding: 10px;
    border-radius: 5px;
    background-color: rgba(255,255,255,0.1);
    margin-bottom: 10px;
    width: fit-content;
}
.chat-box-body-text p {
    margin: 0;
    font-size: 14px;
}
.chat-box-body-text.user {
    justify-content: flex-end;
    margin-left: auto;
}
.chat-box-body-text.user p {
    color: #fff;
}
.chat-box-footer {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80px;
    border-top: 1px solid rgba(255,255,255,0.1);
    position:relative;
}
.chat-box-footer-input {
    flex: 1;
    padding: 10px;
}
.chat-box-footer-input input {
    width: 100%;
    height: 50px;
    border: none;
    padding: 5px 20px;
    background-color: rgba(255,255,255,0.2);
    border-radius: 99px;
}
.chat-box-footer-button {
    padding: 7.5px;
    position: absolute;
    right: 5px;
}
.chat-box-footer-button button {
    background-color: #c9985e;
    color: #fff;
    border: none;
    border-radius: 99px;
    padding: 10px;
    cursor: pointer;
}

/* sidebar hidden on mobile but sidebar toggle must show */
@media (max-width: 768px) {
    .chat-sidebar {
        display: none;
    }
    .chat-sidebar-toggle,.btn-close {
        display: flex;
    }
    .chat-box {
        border-radius: 10px;
    }
    .chat-sidebar.active {
        display: block;
        margin-right: -200px;
        background:#1f1f20;
        z-index: 1;
    }
}

/* sidebar toggle hidden on desktop */
@media (min-width: 768px) {
    .chat-sidebar-toggle,.btn-close {
        display: none;
    }
}

/* chat box body scroll */
.chat-box-body {
    display: flex;
    flex-direction: column-reverse;
}

/* light theming */
.chat-sidebar.active {
    background:#e4e4e4;
}

.chat-box-footer-input input {
    background-color: rgba(255,255,255,1);
}

.chat-box-footer {
    border-top: 1px solid rgba(0,0,0,0.1);
}

.chat-box-body-text.user p {
    color: #111;
}

.chat-box-body-text {
    background-color: rgba(0,0,0,0.1);
}

.chat-box-header {
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.chat-sidebar-sessions-list-item:hover {
    background-color: rgba(0,0,0,0.1);
}

.chat-sidebar-new-session {
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.chat-sidebar-toggle {
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.chat-sidebar {
    background-color: rgba(255, 255, 255, 0.1);
    border-right: 1px solid rgba(0,0,0,0.1);
}

.chat-container {
    background-color: rgba(0, 0, 0, 0.1);
}

/* dark theming */
.dark .chat-sidebar.active {
    background:#1f1f20;
}

.dark .chat-box-footer-input input {
    background-color: rgba(255,255,255,0.2);
}

.dark .chat-box-footer {
    border-top: 1px solid rgba(255,255,255,0.1);
}

.dark .chat-box-body-text.user p {
    color: #fff;
}

.dark .chat-box-body-text {
    background-color: rgba(255,255,255,0.1);
}

.dark .chat-box-header {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.dark .chat-sidebar-sessions-list-item:hover {
    background-color: rgba(255,255,255,0.1);
}

.dark .chat-sidebar-new-session {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.dark .chat-sidebar-toggle {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.dark .chat-sidebar {
    background-color: rgba(0, 0, 0, 0.1);
    border-right: 1px solid rgba(255,255,255,0.1);
}

.dark .chat-container {
    background-color: rgba(255, 255, 255, 0.1);
}
</style>

<div class="chat-section">

    <div class="chat-container">
        <div class="chat-sidebar">
            <!-- new session button -->
            <div class="chat-sidebar-new-session">
                <button class="btn-ns">New Session</button>
                <button class="btn-close">
                    <!-- svg close icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- list old sessions -->
            <div class="chat-sidebar-sessions">
                <div class="chat-sidebar-sessions-list">
                    <div class="chat-sidebar-sessions-list-item">
                        <p>Session 1</p>
                    </div>
                    <div class="chat-sidebar-sessions-list-item">
                        <p>Session 2</p>
                    </div>
                    <div class="chat-sidebar-sessions-list-item">
                        <p>Session 3</p>
                    </div>
                    <div class="chat-sidebar-sessions-list-item">
                        <p>Session 4</p>
                    </div>
                    <div class="chat-sidebar-sessions-list-item">
                        <p>Session 5</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="chat-box">
            <div class="chat-box-header">
                <div class="chat-sidebar-toggle">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
                <div class="chat-box-header-text">
                    <h4>Grand AI</h4>
                </div>
            </div>
            <div class="chat-box-body">
                <div class="chat-box-body-text">
                    <p>Hi, I'm Grand AI. How can I help you today?</p>
                </div>
            </div>
            <div class="chat-box-footer">
                <div class="chat-box-footer-input">
                    <input type="text" placeholder="Type a message...">
                </div>
                <div class="chat-box-footer-button">
                    <button>
                        <!--send icon svg up arrow-->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
/* write all javascript here */
document.querySelector('.chat-sidebar-toggle button').addEventListener('click', function() {
    document.querySelector('.chat-sidebar').classList.toggle('active');
});
/*hide sidebar on btn-close click*/
document.querySelector('.btn-close').addEventListener('click', function() {
    document.querySelector('.chat-sidebar').classList.remove('active');
});

document.querySelector('.chat-sidebar-sessions-list-item').addEventListener('click', function() {
    document.querySelector('.chat-box-body').innerHTML += `
        <div class="chat-box-body-text user">
            <p>Hi, I'm Grand AI. How can I help you today?</p>
        </div>
    `;
});
document.querySelector('.chat-box-footer button').addEventListener('click', function() {
    let message = document.querySelector('.chat-box-footer-input input').value;
    document.querySelector('.chat-box-body').innerHTML += `
        <div class="chat-box-body-text">
            <p>${message}</p>
        </div>
    `;
    document.querySelector('.chat-box-footer-input input').value = '';
});

</script>

</x-filament-panels::page>
