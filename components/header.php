<header>
  <div id="left">
  <?php if($_SERVER['PHP_SELF'] !== '/views/create_poll_page.php'): ?>
    <button id="back-button">
      <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M5.12667 9.96168C5.25291 9.65721 5.46659 9.397 5.74071 9.21396C6.01482 9.03092 6.33706 8.93327 6.66667 8.93335H23.3333C24.8654 8.93335 26.3825 9.23512 27.798 9.82142C29.2134 10.4077 30.4996 11.2671 31.5829 12.3504C32.6663 13.4338 33.5256 14.7199 34.1119 16.1354C34.6982 17.5508 35 19.0679 35 20.6C35 22.1321 34.6982 23.6492 34.1119 25.0647C33.5256 26.4801 32.6663 27.7662 31.5829 28.8496C30.4996 29.9329 29.2134 30.7923 27.798 31.3786C26.3825 31.9649 24.8654 32.2667 23.3333 32.2667H8.33333C7.89131 32.2667 7.46738 32.0911 7.15482 31.7785C6.84226 31.466 6.66667 31.042 6.66667 30.6C6.66667 30.158 6.84226 29.7341 7.15482 29.4215C7.46738 29.1089 7.89131 28.9334 8.33333 28.9334H23.3333C25.5435 28.9334 27.6631 28.0554 29.2259 26.4926C30.7887 24.9298 31.6667 22.8102 31.6667 20.6C31.6667 18.3899 30.7887 16.2703 29.2259 14.7075C27.6631 13.1447 25.5435 12.2667 23.3333 12.2667H10.69L13.6783 15.255C13.9819 15.5694 14.1499 15.9904 14.1461 16.4274C14.1423 16.8643 13.967 17.2824 13.658 17.5914C13.349 17.9004 12.931 18.0757 12.494 18.0795C12.057 18.0833 11.636 17.9153 11.3217 17.6117L5.48833 11.7783C5.25511 11.5453 5.09626 11.2483 5.03189 10.9249C4.96751 10.6015 5.00049 10.2663 5.12667 9.96168Z"
          fill="#141204" />
      </svg>
    </button>
    <?php endif; ?>
  </div>
  <div id="center">
    <h1>Rachel Square</h1>
    <p>A real-time voting website</p>
  </div>
  <div id="right">
  <div id="login">
  <?php if($_SERVER['PHP_SELF'] === '/index.php'): ?>
      <form method="GET" action="views/login_page.php">
        <button id="login-button">
          <svg width="40px" height="41px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.00098 11.999L16.001 11.999M16.001 11.999L12.501 8.99902M16.001 11.999L12.501 14.999" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.3531 21.8897 19.1752 21.9862 17 21.9983M9.00195 17C9.01406 19.175 9.11051 20.3529 9.87889 21.1213C10.5202 21.7626 11.4467 21.9359 13 21.9827" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </button>
        <?php endif; ?>
    </div>
     <div id="logout"> 
     <?php if($_SERVER['PHP_SELF'] === '/views/create_poll_page.php'): ?>
       <form method="POST" action="/api/logout.php"> 
        <button id="logout-button">
          <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M8.33333 35.6C7.41667 35.6 6.63222 35.2739 5.98 34.6216C5.32778 33.9694 5.00111 33.1844 5 32.2666V8.93331C5 8.01664 5.32667 7.2322 5.98 6.57998C6.63333 5.92775 7.41778 5.60109 8.33333 5.59998H20V8.93331H8.33333V32.2666H20V35.6H8.33333ZM26.6667 28.9333L24.375 26.5166L28.625 22.2666H15V18.9333H28.625L24.375 14.6833L26.6667 12.2666L35 20.6L26.6667 28.9333Z"
              fill="#141204" />
          </svg>
        </button>
      </form>
    </div> 
    <?php endif; ?>
  </div>
</header>