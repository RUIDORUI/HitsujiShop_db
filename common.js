function pwsVisible(i, t) {
    const togglePassword = document.querySelector(t);
    const inputPassword = document.querySelector(i);
    // const togglePassword = t
    // const inputPassword = i;


    togglePassword.addEventListener('click', function() {
        const type = inputPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        inputPassword.setAttribute('type', type);
        this.classList.toggle('bi-eye-slash-fill');
    });
}

function signIn() {
    $.ajax({
        type: 'post',
        url: 'http://hitsujishop_test.com:6080/php/sign.php?do=signIn',
        dataType: 'html',
        data: $('#signIn_Form').serialize(),
        success: function(data) {
            let response = JSON.parse(data);
            let accountName = response.accountName;
            let result = response.result;

            switch (result) {
                case 'true':
                    $('#signIn_Form').fadeOut('slow', function() {
                        $(this).remove();

                    });
                    $('#signInForm_Wrapper').html(`<h1>${accountName}<h1>`);
                    console.log('123form');
                    break;
                case 'name_False':
                    console.log(result);
                    break;
                case 'false':
                    console.log(result);
                    break;

                default:
                    console.log('555');
                    break;
            }
            console.log(accountName);
            console.log(response);
        },
        error: function(xhr) {
            alert(xhr.status);
        }
    })
}






function showSignIn() {
    $('.footer').after('<div id="signIn_Section"></div>');


    $('#signIn_Section').html(`
        <div id="signInForm_Wrapper">
            <form action="javascript:signIn()" id="signIn_Form">
                <h1>Sign In</h1>
                <h4>Please Fill Informations Below</h4>

                <div class="signInInput_Wrapper">
                    <div class="signInInput_Field">
                        <h4>Account Name：</h4>
                        <input type="text" name="signIn_Account" id="signIn_Account" placeholder="Enter Your Name">
                    </div>
                    <div class="signInInput_Field">
                        <h4>Password：</h4>
                        <input type="password" name="signIn_Password" id="signIn_Password" placeholder="Enter Your Password">
                        <i class="bi bi-eye-fill" id="toggle_Signin"></i>
                    </div>
                    <button class="signIn_Button" id="signin_Submit" type="submit">Confirm</button>
                    <a href="" class="signIn_Button" id="signIn_Forget">Forget Password?</a>
                </div>
                <div class="signIn_Create">
                    <h4>Don't Have a Account? <a href="http://hitsujishop_test.com:6080/signup.html" id="signIn_CreateLink">Create One.</a></h4>
                </div>

            </form>
        </div>`);
    console.log('signin');

    pwsVisible('#signIn_Password', '#toggle_Signin');
    $('#signInForm_Wrapper').fadeIn('slow');

    $('#signIn_Section').on('click', function(e) {
        if (e.target == this) {
            $(this).fadeOut(500, function() {
                $(this).remove();
            });


        }
    });
}