{include "_header.tpl"}

<img class="background" src="/assets/dice.svg">

<div id="root">
  <div tabindex="-1" class="App">

    <div class="console-container">
      <div class="line howto">
        To roll dice, enter a formula like <strong>2d20+1d8+4</strong>
        <br>For dark theme, type <b>/dark</b>
        <br>To clear screen, type <b>/clear</b>
        <br><a href="https://github.com/SergeyTsalkov/diceroll">We use true randomness from random.org</a>
      </div>
    </div>

    <div class="line input">
      <img src="/assets/in.svg">
      <img class="working spin" style="display: none;" src="/assets/spinner.svg">
      <form>
        <input type="text" autofocus="true"></input>
      </form>
    </div>

  </div>
</div>

{include "_footer.tpl"}