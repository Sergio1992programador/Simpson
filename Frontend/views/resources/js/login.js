import { renderHeader } from "../../components/header";
document.getElementById("loginForm").addEventListener("submit", async(e)=>{
    e.preventDefault();
    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;
const res = await fetch(
    "http://localhost/lossimpson/Backend/public/login",
    {
        method: "POST",
        headers: {"Content-Type":"aplication/json"},
        body: JSON.stringify(usuario,password)
    }
);
const data = await res.json();
if(data.token){
    localStorage.setItem("token", data.token);
    window.location.href = "index.html";
}else{
    alert("Login fallido");
}
});

console.log("Me llaman desde login");
renderHeader(true);
