import A from"./Layout-436e6011.js";import $ from"./Card-ffe66b20.js";import{e as f,f as I,o as l,g as N,w as V,a as v,u as k,Z as q,b as r,t as _,c as g,h as w,n as L,d as O,F as x,i as E,j as P}from"./app-47daf49c.js";import{s as z}from"./showdown-711165a8.js";import B from"./Column-7b7452c0.js";import"./Board-64db47fb.js";const F={class:"header"},Z=["src"],G={class:"toggle-switch"},J=["checked"],K=r("span",{class:"slider"},null,-1),Q={class:"columns drag-container"},R=["id"],U={class:"glass column"},W=["onClick"],X={class:"card-container"},Y=["onClick","id"],tt=["src"],et=["innerHTML"],ot=["innerHTML","onChange"],st=r("div",{class:"card-droptarget"},null,-1),rt=["onClick"],nt=r("div",{class:"droptarget"},null,-1),gt={__name:"Board",props:{board:Object,columns:Object},setup(c){const b=c,C=t=>{B.methods.open(t)},T=t=>{$.methods.open(t)},y=new z.Converter;y.setOption("simpleLineBreaks",!0);function D(t){return t=y.makeHtml(t),t=t.replace(/\[ \]/g,'<input type="checkbox" onclick="event.stopPropagation()">'),t=t.replace(/\[x\]/g,'<input type="checkbox" checked onclick="event.stopPropagation()">'),t}function M(t){const a=t.match(/[^\r\n]+/g),i=[];return a.forEach(s=>{let n=s.trim();n.charAt(0)!=="-"&&n.charAt(0)!=="+"&&(n="- "+n);let e;for(e=0;e<s.length&&s[e]==="	";e++);const o={done:n[0]==="+",text:n.substring(1).trim(),lvl:e};i.push(`<div>${'<i class="mx-2"></i>'.repeat(o.lvl)}<label class="cursor-pointer"><input type="checkbox" ${o.done?"checked":""}> ${o.text}</label></div>`)}),i.join("")}function S(t){t.stopPropagation()}function H(t,a){const i=t.currentTarget.children,s=[];for(let e=0;e<i.length;e++){const o=i[e].querySelector("input").checked,d=i[e].querySelector("label").innerText.trim(),p=i[e].querySelectorAll("i.mx-2").length;s.push(`${"	".repeat(p)}${o?"+":"-"} ${d}`)}const n=s.join(`
`);return f.put("/cards/todo/"+a,{todo:n}),n}let u;document.addEventListener("dragstart",function(t){u=t.target.classList.contains("card"),u?t.dataTransfer.setData("Text",t.target.closest(".card").id):t.dataTransfer.setData("Text",t.target.closest(".drag").id),t.target.classList.add("moving")}),document.addEventListener("drag",function(t){}),document.addEventListener("dragend",function(t){t.target.classList.remove("moving")}),document.addEventListener("dragenter",function(t){const a=u?"card-droptarget":"droptarget";t.target.classList.contains(a)&&t.target.classList.add("active")}),document.addEventListener("dragover",function(t){t.preventDefault()}),document.addEventListener("dragleave",function(t){const a=u?"card-droptarget":"droptarget";t.target.classList.contains(a)&&t.target.classList.remove("active")}),document.addEventListener("drop",function(t){t.preventDefault();const a=u?"card-droptarget":"droptarget";if(t.target.classList.contains(a))if(u){const s=document.getElementById(t.dataTransfer.getData("Text")),n=s.nextSibling;t.target.after(s),s.after(n);const e=[],o=s.closest(".drag").getAttribute("id"),d=s.getAttribute("id").substring(5),p=s.closest(".card-container").children;for(let h=0;h<p.length;h++)p[h].classList.contains("card")&&e.push(p[h].id.substring(5));f.put("/cards/sort/"+o+"/"+d,e),t.target.classList.remove("active")}else{const s=t.target.closest(".drag-container");s.insertBefore(document.getElementById(t.dataTransfer.getData("Text")),t.target.closest(".drag").nextSibling),t.target.classList.remove("active");const n=[];for(var i=0;i<s.children.length;i++)s.children[i].classList.contains("drag")&&n.push(s.children[i].id);f.put("/columns/sort/"+b.board.id,n)}});let m=I(b.board.dark);function j(){m.value=!m.value,f.put("/boards/switch/"+b.board.id,{dark:m.value})}return(t,a)=>(l(),N(A,null,{default:V(()=>{var i,s,n;return[v(k(q),{title:"Board / "+c.board.title},null,8,["title"]),r("div",{class:L(["board",k(m)?"mode-light":"mode-dark"]),style:P([(i=c.board)!=null&&i.background?{backgroundImage:"url("+((s=c.board)==null?void 0:s.background)+")"}:{}])},[r("div",F,[r("img",{src:(n=c.board)==null?void 0:n.icon,class:"icon"},null,8,Z),r("h1",null,_(c.board.title),1),r("div",G,[r("label",null,[r("input",{type:"checkbox",onClick:a[0]||(a[0]=e=>j()),checked:!k(m)},null,8,J),K])])]),r("div",Q,[(l(!0),g(x,null,w(c.columns,e=>(l(),g("div",{id:e.id,class:"drag"},[r("div",U,[r("h4",{class:L(["text-lg font-bold px-2 py-1",{"text-white":c.board.dark}]),draggable:"true"},[r("a",{class:"float-right cursor-pointer",onClick:o=>C(e)},"⚙️",8,W),O(" "+_(e.title),1)],2),r("div",X,[(l(!0),g(x,null,w(e.cards,o=>(l(),g(x,null,[r("div",{class:"card cursor-pointer shadow-md drag-card",onClick:d=>T(o),draggable:"true",id:"card-"+o.id},[r("img",{src:o.cover,draggable:"false"},null,8,tt),r("h6",{class:L(["px-2 py-1 title",{"top-title":o.description||o.todo}])},_(o.title),3),o.description?(l(),g("div",{key:0,class:"description",innerHTML:D(o.description)},null,8,et)):E("",!0),o.todo?(l(),g("div",{key:1,class:"checklist p-2 cursor-default",innerHTML:M(o.todo),onClick:a[1]||(a[1]=d=>S(d)),onChange:d=>o.todo=H(d,o.id)},null,40,ot)):E("",!0)],8,Y),st],64))),256))]),r("a",{class:"btn-create glass",onClick:o=>T({title:"",column_id:e.id})},"Create new",8,rt)]),nt],8,R))),256)),r("div",{class:"glass column add",onClick:a[2]||(a[2]=e=>C({title:"New column",board_id:c.board.id}))})])],6),v(B),v($)]}),_:1}))}};export{gt as default};