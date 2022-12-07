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

    <link rel="shortcut icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NDAgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuMi4xIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIyIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBkPSJNMjUyLjMgMTEuN2MtMTUuNi0xNS42LTQwLjktMTUuNi01Ni42IDBsLTE4NCAxODRjLTE1LjYgMTUuNi0xNS42IDQwLjkgMCA1Ni42bDE4NCAxODRjMTUuNiAxNS42IDQwLjkgMTUuNiA1Ni42IDBsMTg0LTE4NGMxNS42LTE1LjYgMTUuNi00MC45IDAtNTYuNmwtMTg0LTE4NHpNMjQ4IDIyNGMwIDEzLjMtMTAuNyAyNC0yNCAyNHMtMjQtMTAuNy0yNC0yNHMxMC43LTI0IDI0LTI0czI0IDEwLjcgMjQgMjR6TTk2IDI0OGMtMTMuMyAwLTI0LTEwLjctMjQtMjRzMTAuNy0yNCAyNC0yNHMyNCAxMC43IDI0IDI0cy0xMC43IDI0LTI0IDI0em0xMjggODBjMTMuMyAwIDI0IDEwLjcgMjQgMjRzLTEwLjcgMjQtMjQgMjRzLTI0LTEwLjctMjQtMjRzMTAuNy0yNCAyNC0yNHptMTI4LTgwYy0xMy4zIDAtMjQtMTAuNy0yNC0yNHMxMC43LTI0IDI0LTI0czI0IDEwLjcgMjQgMjRzLTEwLjcgMjQtMjQgMjR6TTIyNCA3MmMxMy4zIDAgMjQgMTAuNyAyNCAyNHMtMTAuNyAyNC0yNCAyNHMtMjQtMTAuNy0yNC0yNHMxMC43LTI0IDI0LTI0em05NiAzOTJjMCAyNi41IDIxLjUgNDggNDggNDhINTkyYzI2LjUgMCA0OC0yMS41IDQ4LTQ4VjI0MGMwLTI2LjUtMjEuNS00OC00OC00OEg0NzIuNWMxMy40IDI2LjkgOC44IDYwLjUtMTMuNiA4Mi45TDMyMCA0MTMuOFY0NjR6bTE2MC04OGMtMTMuMyAwLTI0LTEwLjctMjQtMjRzMTAuNy0yNCAyNC0yNHMyNCAxMC43IDI0IDI0cy0xMC43IDI0LTI0IDI0eiIvPjwvc3ZnPg==">

    <title>Dice Roller!</title>
  </head>
  <body>
