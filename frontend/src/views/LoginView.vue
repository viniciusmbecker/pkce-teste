<template>
    <div>
        Olá, faça o login
        <br/>
        <button role="button" @click="entrar">LOGIN(ENTRAR)</button>
    </div>
</template>

<script>

export default {
    methods: {
        entrar() {
            let pkce = this.geraPKCE();
 
            localStorage.setItem("code_verifier", pkce.get("code_verifier"));

            window.location.href = "http://localhost:4080/onelogin/login" + "?code_challenge=" + pkce.get("code_challenge");
        },
        geraPKCE() {
            let code_verifier = "";

            let chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_";

            for (let i = 0; i < 128; i++) {
                code_verifier += chars.charAt(Math.floor(Math.random() * chars.length));
            }

            let sha256 = require("js-sha256").sha256;

            let code_challenge = sha256(code_verifier);

            let pkce = new Map();

            pkce.set("code_verifier", code_verifier);
            pkce.set("code_challenge", code_challenge);

            return pkce;
        }
    }
}

</script>