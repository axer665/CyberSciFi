<div>
    <form action="/registration/send" method="post" id="form__registration">
        <input type="text" placeholder="name" class="form__login" name="login" />
        <input type="email" placeholder="email" class="form__email" name="email" />
        <input type="password" placeholder="password" class="form__password" name="password" />
        <input type="password" placeholder="password_confirm" class="form__password_confirm" name="password_confirm" />
        <input type="submit" value="send" />
    </form>
</div>

<script src="/src/Core/Views/scripts/registration.js" type="module"></script>