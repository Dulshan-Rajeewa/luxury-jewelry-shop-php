<footer>
    <div class="footerLeft">
        <div class="footerMenu">
            <h1 class="fMenuTitle">About Us</h1>
            <ul class="fList">
                <li class="fListItem">Company</li>
                <li class="fListItem">Contact</li>
                <li class="fListItem">Careers</li>
                <li class="fListItem">Affiliates</li>
                <li class="fListItem">Stores</li>
            </ul>
        </div>
        <div class="footerMenu">
            <h1 class="fMenuTitle">Useful Links</h1>
            <ul class="fList">
                <li class="fListItem">Support</li>
                <li class="fListItem">Refund</li>
                <li class="fListItem">FAQ</li>
                <li class="fListItem">Feedback</li>
                <li class="fListItem">Stories</li>
            </ul>
        </div>
    </div>
    <div class="footerRight">
        <div class="footerRightMenu">
            <h1 class="fMenuTitle">Follow Us</h1>
            <div class="fIcons">
                <i class="bi bi-facebook fIcon"></i>
                <i class="bi bi-twitter fIcon"></i>
                <i class="bi bi-instagram fIcon"></i>
                <i class="bi bi-whatsapp fIcon"></i>
            </div>
        </div>
        <div class="footerRightMenu">
            <span class="copyright">@Dulshan Rajeewa. All rights reserved. 2025.</span>
        </div>
    </div>
</footer>

<style>
  footer {
    display: flex;
    justify-content: space-between; 
    align-items: flex-start;
    padding: 30px 50px; 
    background-color: #222;  
  }

  .footerLeft, .footerRight {
    display: flex;
    align-items: flex-start; 
  }

  .footerLeft {
    flex: 2;
    justify-content: space-between; 
  }

  .footerMenu {
    margin-right: 30px;
  }

  .fMenuTitle {
    font-size: 16px;
    color: white; 
    margin-bottom: 10px;
  }

  .fList {
    padding: 0;
    list-style: none;
  }

  .fListItem {
    margin-bottom: 10px;
    color: gold;
    cursor: pointer;
  }

  .footerRight {
    flex: 1;
    flex-direction: column;
  }

  .fIcons {
    display: flex;
  }

  .fIcon {
    width: 20px;
    height: 20px;
    margin-right: 15px;
    color: white; 
  }

  .copyright {
    font-weight: 300;
    font-size: 14px;
    color: white; 
  }
</style>
