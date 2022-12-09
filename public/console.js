$(function() {
  $('form').submit(function(evt) {
    evt.preventDefault()

    var input = $('input').val()
    
    if (input == "/clear") {
      $('input').val('')
      return clear_screen()
    }

    $.post('/roll', {
      roll: input
    }, function(data) {
      var lineTag = $('<div>')
      lineTag.addClass('Line')

      var inputTag = $('<div>')
      inputTag.addClass('prompt input')
      inputTag.text(input)

      var outputTag = $('<div>')
      outputTag.addClass('prompt output log')
      outputTag.text(data.intermediate + " = " + data.result)

      lineTag.append(inputTag)
      lineTag.append(outputTag)
      $('.console-container').append(lineTag)

      $('input').val('')
    }, 'json')
  })
})

function clear_screen() {
  $('.Line').not(':first').remove()
}