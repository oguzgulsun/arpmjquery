@include('components.header')
<style>
    #div1, #div2 {
    min-height: 50px;
    border: 1px solid black;
    margin-bottom: 10px;
}
</style>
<div>
    <div id="div1">Hello World</div>
<div id="div2"></div>
<button id="myButton">Click me</button>

<button onclick="resetThis()">Reset</button>

</div>
<script>
      var button = document.getElementById("myButton");
  button.addEventListener("click", function() {
    // alert("Button clicked!");
    animatehellotext()
    /**
     *You code goes here
     */    
  });

  function animatehellotext() {
    const div1 = document.getElementById('div1');
    const div2 = document.getElementById('div2');
    const hellotext = div1.innerText;
    div1.innerText = '';

    hellotext.split('').forEach((harf, index) => {
        const span = document.createElement('span');
        span.innerText = harf;
        div1.appendChild(span);

        setTimeout(() => {
            div2.appendChild(span);
        }, calculateDelay(index));
    });
}

function calculateDelay(index) {
    if (index % 2 === 0) { 
        return index === 0 ? 0 : 4000 + index - 1 + 1000; 
    } else { 
        return 4000 + index; 
    }
}
function resetThis(){
    const div1 = document.getElementById('div1');
    const div2 = document.getElementById('div2');
    div1.innerText = 'Hello World';
    div2.innerText = '';
}

</script>

@include('components.footer')