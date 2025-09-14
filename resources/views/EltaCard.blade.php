<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    background: linear-gradient(#212529, #495057);
}
.flip-card {
    box-shadow: 0 8px 32px 0 rgba(255, 255, 255, 0.37);

      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      border-radius: 1rem;
      background-color: rgba(255, 255, 255, 0.37);
      width: 340px;
      height: 214px;
      perspective: 1000px;
      color: white;
}

.heading {
  position: absolute;
  letter-spacing: .2em;
  font-size: 0.8em;
  top: 0.9em;
  right: 18em;
}

.logo {
  position: absolute;
  top: 0.3em;
  left: 17.5em;
}

.chip {
  position: absolute;
  top: 3.3em;
  left: 1.5em;
}

.number {
  position: absolute;
  font-weight: bold;
  font-size: 1.2em;
  top: 6em;
  left: 1em;
}
.cvv2{
  position: absolute;
  font-weight: bold;
  font-size: 0.8em;
  top: 12em;
  right: 1.8em;
}
.cvv2-card {
  position: absolute;
  font-size: 0.7em;
  top: 15em;
  right: 3.5em;
}
.exp{
  position: absolute;
  font-weight: bold;
  font-size: 0.8em;
  top: 12em;
  left: 1.8em;
}
.date {
  position: absolute;
  font-size: 0.7em;
  top: 15em;
  left: 2em;
}

.name {
  position: absolute;
  font-weight: bold;
  font-size: 1em;
  top: 7.5em;
  right: 1.2em;
}

.strip {
  position: absolute;
  background-color: black;
  width: 21.25em;
  height: 3em;
  top: 0em;
  border-top-left-radius: 1rem;
  border-top-right-radius: 1rem;
  background: repeating-linear-gradient(
    45deg,
    #303030,
    #303030 10px,
    #202020 10px,
    #202020 20px
  );
}

.mstrip {
  position: absolute;
  background-color: rgb(255, 255, 255);
  width: 8em;
  height: 0.8em;
  top: 5em;
  left: .8em;
  border-radius: 2.5px;
}

.sstrip {
  position: absolute;
  background-color: rgb(255, 255, 255);
  width: 4.1em;
  height: 0.8em;
  top: 5em;
  left: 10em;
  border-radius: 2.5px;
}

.code {
  font-weight: bold;
  text-align: center;
  margin: .2em;
  color: black;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  box-shadow: 0 8px 14px 0 rgba(0,0,0,0.2);
  position: absolute;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  border-radius: 1rem;
}

.flip-card-front {
  background-color: #171717;
}

.flip-card-back {
  background-color: #171717;
  transform: rotateY(180deg);
}
.qr-code{
  position: absolute;
  top: 4.3em;
  left: 1em;
}
.name-back{
  position: absolute;
  font-size: 1em;
  top: 5em;
  right: 1em;
}
.work-area{
  position: absolute;
  font-size: 0.8em;
  top: 8em;
  right: 1.8em;
}
.card-text{
  position: absolute;
  font-size:0.8em;
  bottom: 0.1em;
  right: 7.5em;
}
.IR{
  position: absolute;
  font-size: 0.8em;
  top: 4.8em;
  right:2em;
} 

.circle {
    box-shadow: 0 8px 32px 0 rgba(255, 255, 255, 0.37);
    z-index: -1;
    position: absolute;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.37);
    animation: fadeCircle 3s ease-in-out infinite;
}

.circle-1 {
    top: 120px;
    right: 250px;
    animation-delay: 0s;
}

.circle-2 {
    bottom: 120px;
    left: 250px;
    animation-delay: 1.5s;
}
.g-qr-code{
  fill: rgba(255, 255, 255, 0.37);
}
.back-g-qr-code{
  fill: #171717;
}
@media (max-width: 700px) {
  .circle{
    display: none;
  }
}

.container {
  position: absolute;
  top: 0.5em;
  right: -45em;
  --s: 1em; /* control the size */
  --g: 10px; /* the gap */
  --c: #009688; /* the active color */

  display: grid;
  grid-auto-rows: 1fr;
  gap: var(--g);
  position: relative;
}
.container:before {
  content: "";
  position: absolute;
  height: calc(var(--s) / 2);
  left: calc(var(--s) / 4 + var(--_x, 0px));
  top: calc(var(--s) / 4);
  background: var(--c);
  border-radius: 50%;
  aspect-ratio: 1;
  transition: 0.4s, left cubic-bezier(0.1, -2000, 0.7, -2000) 0.4s;
}
.container label {
  display: inline-flex;
  line-height: var(--s);
  align-items: center;
  gap: 10px;
  cursor: pointer;
}
.container input {
  height: var(--s);
  aspect-ratio: 1;
  border: calc(var(--s) / 8) solid var(--_c, #939393);
  border-radius: 50%;
  outline-offset: calc(var(--s) / 10);
  padding: calc(var(--s) / 8);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  cursor: pointer;
  font-size: inherit;
  margin: 0;
  transition: 0.3s;
}
.container input:checked {
  --_c: var(--c);
}
.container:not(:has(input:checked)):before {
  --_i: -1;
  opacity: 0;
}
.container:has(input:checked):before {
  opacity: 1;
  transform: translateY(calc(var(--_i) * (var(--s) + var(--g))));
}
.container:has(label:nth-child(1) input:checked):before {
  --_i: 0;
  --_x: 0.02px;
}
.container:has(label:nth-child(2) input:checked):before {
  --_i: 1;
  --_x: 0.04px;
}
.container:has(label:nth-child(3) input:checked):before {
  --_i: 2;
  --_x: 0.06px;
}
.container:has(label:nth-child(4) input:checked):before {
  --_i: 3;
  --_x: 0.08px;
}
.container:has(label:nth-child(5) input:checked):before {
  --_i: 4;
  --_x: 0.1px;
}
/* and so on ..*/

.container input:disabled {
  background: linear-gradient(#939393 0 0) 50%/100% 20% no-repeat content-box;
  opacity: 0.5;
  cursor: not-allowed;
}
@media print {
  input[type="radio"] {
    -webkit-appearance: auto;
    -moz-appearance: auto;
    appearance: auto;
    background: none;
  }
}
@supports not selector(:has(*)) {
  .container:before {
    display: none;
  }
  .container input:checked {
    --_c: var(--c);
    background: var(--c) content-box;
  }
}

  </style>
</head>
<body>
  <div class="container">
    <label><input name="e" type="radio" checked /></label>
    <label><input name="e" type="radio" /></label>
    <label><input name="e" type="radio" /></label>
    <label><input name="e" type="radio" /></label>
    <label><input name="e" type="radio" /></label>
  </div>
  <div class="flip-card">
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
    <div class="flip-card-inner">
        <div class="flip-card-front">
            <p class="heading">ELTACARD</p>
            <img src="../images/logo-white.jpg" class="logo" width="50" height="50" alt="">
            <svg version="1.1" class="chip" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 50 50" xml:space="preserve">  <image id="image0" width="50" height="50" x="0" y="0" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
              AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB6VBMVEUAAACNcTiVeUKVeUOY
              fEaafEeUeUSYfEWZfEaykleyklaXe0SWekSZZjOYfEWYe0WXfUWXe0WcgEicfkiXe0SVekSXekSW
              ekKYe0a9nF67m12ZfUWUeEaXfESVekOdgEmVeUWWekSniU+VeUKVeUOrjFKYfEWliE6WeESZe0GS
              e0WYfES7ml2Xe0WXeESUeEOWfEWcf0eWfESXe0SXfEWYekSVeUKXfEWxklawkVaZfEWWekOUekOW
              ekSYfESZe0eXekWYfEWZe0WZe0eVeUSWeETAnmDCoWLJpmbxy4P1zoXwyoLIpWbjvXjivnjgu3bf
              u3beunWvkFWxkle/nmDivXiWekTnwXvkwHrCoWOuj1SXe0TEo2TDo2PlwHratnKZfEbQrWvPrWua
              fUfbt3PJp2agg0v0zYX0zYSfgkvKp2frxX7mwHrlv3rsxn/yzIPgvHfduXWXe0XuyIDzzISsjVO1
              lVm0lFitjVPzzIPqxX7duna0lVncuHTLqGjvyIHeuXXxyYGZfUayk1iyk1e2lln1zYTEomO2llrb
              tnOafkjFpGSbfkfZtXLhvHfkv3nqxH3mwXujhU3KqWizlFilh06khk2fgkqsjlPHpWXJp2erjVOh
              g0yWe0SliE+XekShhEvAn2D///+gx8TWAAAARnRSTlMACVCTtsRl7Pv7+vxkBab7pZv5+ZlL/UnU
              /f3SJCVe+Fx39naA9/75XSMh0/3SSkia+pil/KRj7Pr662JPkrbP7OLQ0JFOijI1MwAAAAFiS0dE
              orDd34wAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IDx2lsiuJAAACLElEQVRIx2Ng
              GAXkAUYmZhZWPICFmYkRVQcbOwenmzse4MbFzc6DpIGXj8PD04sA8PbhF+CFaxEU8iWkAQT8hEVg
              OkTF/InR4eUVICYO1SIhCRMLDAoKDvFDVhUaEhwUFAjjSUlDdMiEhcOEItzdI6OiYxA6YqODIt3d
              I2DcuDBZsBY5eVTr4xMSYcyk5BRUOXkFsBZFJTQnp6alQxgZmVloUkrKYC0qqmji2WE5EEZuWB6a
              lKoKdi35YQUQRkFYPpFaCouKIYzi6EDitJSUlsGY5RWVRGjJLyxNy4ZxqtIqqvOxaVELQwZFZdkI
              JVU1RSiSalAt6rUwUBdWG1CP6pT6gNqwOrgCdQyHNYR5YQFhDXj8MiK1IAeyN6aORiyBjByVTc0F
              qBoKWpqwRCVSgilOaY2OaUPw29qjOzqLvTAchpos47u6EZyYnngUSRwpuTe6D+6qaFQdOPNLRzOM
              1dzhRZyW+CZouHk3dWLXglFcFIflQhj9YWjJGlZcaKAVSvjyPrRQ0oQVKDAQHlYFYUwIm4gqExGm
              BSkutaVQJeomwViTJqPK6OhCy2Q9sQBk8cY0DxjTJw0lAQWK6cOKfgNhpKK7ZMpUeF3jPa28BCET
              amiEqJKM+X1gxvWXpoUjVIVPnwErw71nmpgiqiQGBjNzbgs3j1nus+fMndc+Cwm0T52/oNR9lsdC
              S24ra7Tq1cbWjpXV3sHRCb1idXZ0sGdltXNxRateRwHRAACYHutzk/2I5QAAACV0RVh0ZGF0ZTpj
              cmVhdGUAMjAyMy0wMi0xM1QwODoxNToyOSswMDowMEUnN7UAAAAldEVYdGRhdGU6bW9kaWZ5ADIw
              MjMtMDItMTNUMDg6MTU6MjkrMDA6MDA0eo8JAAAAKHRFWHRkYXRlOnRpbWVzdGFtcAAyMDIzLTAy
              LTEzVDA4OjE1OjI5KzAwOjAwY2+u1gAAAABJRU5ErkJggg=="></image>
            </svg>

            <p class="number">9759 2484 5269 6576</p>
            <p class="exp">EXP</p>
            <p class="cvv2">CVV2</p>
            <p class="cvv2-card">945</p>
            <p class="date">1 2 / 2 4</p>
            <p class="name">{{ Auth::user()->name}}</p>
        </div>
        <div class="flip-card-back">
            <div class="strip"></div>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" class="qr-code" width="90px" height="90px"  viewBox="0 0 231 231" enable-background="new 0 0 231 231" xml:space="preserve">
              <rect x="0" y="0" width="231" height="231" class="back-g-qr-code"/><g transform="translate(14,14)"><g transform="translate(56,0) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,0) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,0) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,0) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,0) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,0) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,0) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,7) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,14) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,14) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,14) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,14) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,14) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,14) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,14) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,21) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,28) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,35) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,35) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,35) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,35) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,35) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,42) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,42) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,42) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,42) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,42) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,42) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,42) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,49) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,49) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,49) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(21,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(28,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(35,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(42,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(49,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(189,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,56) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(14,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(189,63) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(7,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(14,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(28,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(35,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(42,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,70) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(21,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(28,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,77) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(7,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(14,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(21,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(42,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,84) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(14,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(189,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,91) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(7,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(35,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(42,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(49,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,98) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(7,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(28,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(49,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,105) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(28,112) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(42,112) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,112) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,112) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,112) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,112) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,112) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(21,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(189,119) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(7,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(14,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(42,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(49,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,126) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(7,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(28,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(35,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(49,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,133) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(7,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(14,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(35,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(42,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(189,140) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,147) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,154) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(63,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(189,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,161) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,168) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(98,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(189,175) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(70,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(112,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(189,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,182) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,189) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(91,189) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(105,189) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(147,189) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(161,189) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,189) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(182,189) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(196,189) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(56,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(77,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(84,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(119,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(126,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(133,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(140,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(154,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(168,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(175,196) scale(0.014,0.014)"><g transform=""class="g-qr-code" >
              <path d="M250,0c138.077,0,250,111.93,250,250c0,138.077-111.923,250-250,250C111.93,500,0,388.077,0,250C0,111.93,111.93,0,250,0z"/>
              </g></g><g transform="translate(0,0) scale(0.49, 0.49)"><g transform=" translate(100, 0) scale(-1,1) "class="g-qr-code" >
              <g>
                <path style="fill:none;" d="M85,66.221V33.75C85,23.411,76.414,15,65.859,15H34.14C23.586,15,15,23.411,15,33.75v51.246   l50.855-0.016C76.414,84.98,85,76.564,85,66.221z"/>
                <path d="M100,66.221V33.75C100,15.141,84.68,0,65.859,0H34.14C15.32,0,0,15.141,0,33.75V100l65.859-0.02   C84.68,99.98,100,84.84,100,66.221z M85,66.221c0,10.344-8.586,18.76-19.145,18.76L15,84.996V33.75C15,23.411,23.586,15,34.14,15   h31.719C76.414,15,85,23.411,85,33.75V66.221z"/>
              </g>
              </g></g><g transform="translate(154,0) scale(0.49, 0.49)"><g transform=""class="g-qr-code" >
              <g>
                <path style="fill:none;" d="M85,66.221V33.75C85,23.411,76.414,15,65.859,15H34.14C23.586,15,15,23.411,15,33.75v51.246   l50.855-0.016C76.414,84.98,85,76.564,85,66.221z"/>
                <path d="M100,66.221V33.75C100,15.141,84.68,0,65.859,0H34.14C15.32,0,0,15.141,0,33.75V100l65.859-0.02   C84.68,99.98,100,84.84,100,66.221z M85,66.221c0,10.344-8.586,18.76-19.145,18.76L15,84.996V33.75C15,23.411,23.586,15,34.14,15   h31.719C76.414,15,85,23.411,85,33.75V66.221z"/>
              </g>
              </g></g><g transform="translate(0,154) scale(0.49, 0.49)"><g transform=" translate(100, 0) scale(-1,1)  translate(0,100) scale(1,-1) "class="g-qr-code" >
              <g>
                <path style="fill:none;" d="M85,66.221V33.75C85,23.411,76.414,15,65.859,15H34.14C23.586,15,15,23.411,15,33.75v51.246   l50.855-0.016C76.414,84.98,85,76.564,85,66.221z"/>
                <path d="M100,66.221V33.75C100,15.141,84.68,0,65.859,0H34.14C15.32,0,0,15.141,0,33.75V100l65.859-0.02   C84.68,99.98,100,84.84,100,66.221z M85,66.221c0,10.344-8.586,18.76-19.145,18.76L15,84.996V33.75C15,23.411,23.586,15,34.14,15   h31.719C76.414,15,85,23.411,85,33.75V66.221z"/>
              </g>
              </g></g><g transform="translate(14,14) scale(0.21, 0.21)"><g transform=" translate(100, 0) scale(-1,1) "class="g-qr-code" >
              <path d="M100,72.779V27.195C100,12.203,87.604,0,72.37,0H27.63C12.397,0,0,12.203,0,27.195V100l72.37-0.042  C87.604,99.958,100,87.771,100,72.779z"/>
              </g></g><g transform="translate(168,14) scale(0.21, 0.21)"><g transform=""class="g-qr-code" >
              <path d="M100,72.779V27.195C100,12.203,87.604,0,72.37,0H27.63C12.397,0,0,12.203,0,27.195V100l72.37-0.042  C87.604,99.958,100,87.771,100,72.779z"/>
              </g></g><g transform="translate(14,168) scale(0.21, 0.21)"><g transform=" translate(100, 0) scale(-1,1)  translate(0,100) scale(1,-1) "class="g-qr-code" >
              <path d="M100,72.779V27.195C100,12.203,87.604,0,72.37,0H27.63C12.397,0,0,12.203,0,27.195V100l72.37-0.042  C87.604,99.958,100,87.771,100,72.779z"/>
              </g></g></g>
            </svg>
            <p class="name-back">{{ Auth::user()->name}}</p>
            <p class="work-area">{{ Auth::user()->workarea ?? 'کاربر التا'}}</p>
            <p class="card-text">!این کارت یه عابر بانک ساده نیست</p>
            <p class="IR">IR03 0120 00000 00000 8467 1837 53</p>
        </div>
    </div>
</div>
<script>
const container = document.querySelector('.container');
  const inputs = document.querySelectorAll('input[type="radio"]');
  
  const gQrCodes = document.querySelectorAll('.g-qr-code');
  const backGQrCodes = document.querySelectorAll('.back-g-qr-code');
  const circles = document.querySelectorAll('.circle');
  const flipCardFronts = document.querySelectorAll('.flip-card-front');
  const flipCardBacks = document.querySelectorAll('.flip-card-back');
  const flipCards = document.querySelectorAll('.flip-card');
  
  // تم‌ها شامل رنگ متن کارت هم هستن
  const themes = [
    {
      gQrCodeFill: '#ffffff5E',
      backGQrCodeFill: '#171717',
      circleBg: '#ffffff5E',
      circleShadow: '#ffffff5E',
      flipCardFrontBg: '#171717',
      flipCardBackBg: '#171717',
      flipCardBg: '#ffffff5E',
      flipCardShadow: '#ffffff5E',
      flipCardTextColor: '#ffffff',
      bodyBackground: 'linear-gradient(#212529, #495057)'
    },
    {
      gQrCodeFill: '#059212',
      backGQrCodeFill: '#114232',
      circleBg: '#12372A',
      circleShadow: '#12372A',
      flipCardFrontBg: '#114232',
      flipCardBackBg: '#114232',
      flipCardBg: '#12372A',
      flipCardShadow: '#12372A',
      flipCardTextColor: '#ffffff',
      bodyBackground: 'linear-gradient(#114232, #495057)'
    },
    {
      gQrCodeFill: '#155E95',
      backGQrCodeFill: '#000957',
      circleBg: '#133E87',
      circleShadow: '#133E87',
      flipCardFrontBg: '#000957',
      flipCardBackBg: '#000957',
      flipCardBg: '#133E87',
      flipCardShadow: '#133E87',
      flipCardTextColor: '#ffffff',
      bodyBackground: 'linear-gradient(#133E87, #495057)'
    },
    {
      gQrCodeFill: '#b10000',
      backGQrCodeFill: '#3D0301',
      circleBg: '#800000',
      circleShadow: '#b10000 ',
      flipCardFrontBg: '#3D0301',
      flipCardBackBg: '#3D0301',
      flipCardBg: '#800000',
      flipCardShadow: '#b10000',
      flipCardTextColor: '#ffffff',
      bodyBackground: 'linear-gradient(#3D0301, #495057)'
    },
    {
      gQrCodeFill: '#171717',
      backGQrCodeFill: '#F0EBE3',
      circleBg: '#171717',
      circleShadow: '#171717',
      flipCardFrontBg: '#F0EBE3',
      flipCardBackBg: '#F0EBE3',
      flipCardTextColor: '#000000',
      flipCardBg: '#171717',
      flipCardShadow: '#171717',
      bodyBackground: 'linear-gradient(#777777, #171717)'
    }
  ];
  function updateStyles(theme) {
  gQrCodes.forEach(el => el.style.fill = theme.gQrCodeFill);
  backGQrCodes.forEach(el => el.style.fill = theme.backGQrCodeFill);

  circles.forEach(el => {
    el.style.backgroundColor = theme.circleBg;
    el.style.boxShadow = `0 8px 32px 0 ${theme.circleShadow}`;
  });

  flipCardFronts.forEach(el => {
    el.style.backgroundColor = theme.flipCardFrontBg;
    el.style.color = theme.flipCardTextColor;
  });

  flipCardBacks.forEach(el => {
    el.style.backgroundColor = theme.flipCardBackBg;
    el.style.color = theme.flipCardTextColor;
  });

  flipCards.forEach(el => {
    el.style.backgroundColor = theme.flipCardBg;
    el.style.boxShadow = `0 8px 32px 0 ${theme.flipCardShadow}`;
  });

  document.body.style.background = theme.bodyBackground;
}

// رنگ اولیه
updateStyles(themes[0]);

// رویداد برای دکمه‌ها
inputs.forEach((input, index) => {
  input.addEventListener('change', () => {
    if (input.checked) {
      updateStyles(themes[index]);
    }
  });
});
  

    const colors = ['#171717', '#114232', '#000957', '#3D0301', '#F0EBE3'];
    

    // تنظیم رنگ اولیه
    container.style.setProperty('--c', colors[0]);

    // تغییر رنگ با کلیک
    inputs.forEach((input, index) => {
      input.addEventListener('change', () => {
        if (input.checked) {
          container.style.setProperty('--c', colors[index]);
        }
      });
    });
</script>
</body>
</html>