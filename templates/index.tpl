{include "_header.tpl"}

<img class="background" src="/assets/dice.svg">

<div id="root">
  <div tabindex="-1" class="App">

    <div class="console-container">
      <div class="Line">
        <div class="prompt output log">
          <div class="type string bareString">
            To roll dice, enter a formula like <strong>2d20+1d8+4</strong>
            <br>To clear screen, type <b>/clear</b>
            <br>We use true randomness from random.org
          </div>
        </div>
      </div>
    </div>

    <div class="Input">
      {* <img class="spin" src="/assets/spinner.svg"> *}
      <form>
        <input class="cli" rows="1" autofocus="true"></input>
      </form>
    </div>

  </div>
</div>

{include "_footer.tpl"}