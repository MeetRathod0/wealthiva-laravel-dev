</div>
        <!-- ---END BODY -->

        <!-- <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024.   <a href="https://www.bootstrapdash.com/" target="_blank">RMeet.in</a> All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Made with <i class='bx bxs-heart' style="color: red; font-size: 1rem;"></i></span>
          </div>
        </footer> -->

      </div>

    </div>   
    <!-- END MAIN BODY -->
     
  </div>

   <script>

            document.getElementById('logoutBtn').addEventListener('click', function () {
                console.log("Logout button clicked");
               axios.post('/api/logout',[],{headers: {
                          'Content-Type': 'application/json'
                      },
                      withCredentials: true }).then(function (response) {
                   window.location.href = "/login";
                   //console.log(response);
               }).catch(function (error) {
                  //console.error('Logout failed:', error);
                  window.location.href = "/login";
               });
            });
        </script>



</body>
</html>

