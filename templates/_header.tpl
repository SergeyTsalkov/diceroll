{function link}
  {if $rtname}
    <a class="{if $route_name eq $rtname}active{/if}" href="{pathFor rtname=$rtname}">{$text}</a>
  {elseif $href}
    <a href="{$href}">{$text}</a>
  {else}
    <a href="#">{$text}</a>
  {/if}
{/function}

{*
  style based on:
  https://v2.docusaurus.io/showcase/
  https://facebook.github.io/flux/
*}

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Roll dice for games like Dungeons & Dragons!">

    {link_tag rel="stylesheet" href="/console.css"}

    <title>Dice Roller!</title>
  </head>
  <body>
