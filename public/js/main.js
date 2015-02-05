var timer;

function doTimer()
{
	timer = setInterval(function() {
		var start = parseInt($('.timer-clock').data('start'), 10),
			date = new Date(),
			current = new Date();

		date.setTime(start);

		var diff = (current.getTime() - date.getTime()),
			diffSecs = parseInt(diff / 1000, 10);

		var ms = diff % 1000;
		diff = (diff - ms) / 1000;
		var secs = diff % 60;
		diff = (diff - secs) / 60;
		var mins = diff % 60;
		var hours = (diff - mins) / 60;

		var timeString = 'secs';
		var displayString = '';

		if( diffSecs <= 59 ) {
			timeString = 'secs';
			displayString = secs;
		} else if ( diffSecs <= 3599 ) {
			timeString = 'mins';
			displayString = mins + ':' + secs;
		} else {
			timeString = 'hours';
			displayString = hours + ':' + mins + ':' + secs;
		}

		displayString = displayString + ' ' + timeString;
		$('.timer-clock').html(displayString);
	}, 1000);
}

$(document).on('click', '.timer-btn-start', function( event ) {
	"use strict";
	event.preventDefault();

	var name = $('#name').val(),
		project = $('#project').val(),
		$this = $(this);

	if( name === '' ) {
		alert('Name cannot be blank');
		return;
	}

	if( project === '-1' ) {
		alert('You must select a valid project');
		return;
	}

	$.ajax({
		type: "POST",
		url: "/timer",
		data: { name: name, project: project },
		dataType: 'json'
	}).success(function(res) {
		$('<span class="timer-clock" data-start="'+res.data.start+'000"></span>').insertBefore($this);
		$this.addClass('timer-btn-stop').removeClass('timer-btn-start');
		$this.addClass('btn-danger').removeClass('btn-success');
		$this.html('Stop');
		$this.data( 'id', res.data.id );
		var start = new Date();
		start.setTime(parseInt(res.data.start + '000'));
		var month = [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'AugSep', 'Oct', 'Nov', 'Dec' ];
		var mins = start.getMinutes() < 10 ? '0' + start.getMinutes() : start.getMinutes();
		var secs = start.getSeconds() < 10 ? '0' + start.getSeconds() : start.getSeconds();
		start = start.getDate() + ' ' + month[start.getMonth()] + ' ' + start.getFullYear() + ' ' + start.getHours() + ' ' + mins + ':' + secs;
		var row = '<tr>' +
			'<td>'+res.data.name+'<br/><small>'+res.data.project+'</small></td>' +
			'<td>'+start+'</td>' +
			'<td>running</td>' +
			'<td></td>' +
			'</tr>';
		$('table > tbody > tr:first').before(row);

		doTimer();
	});
});

$(document).on('click', '.timer-btn-stop', function( event ) {
	"use strict";
	event.preventDefault();

	var $this = $(this);

	$.ajax({
		type: "PUT",
		url: "/timer/" + $(this).data('id'),
		dataType: 'json'
	}).success(function(res) {
		$this.html('Start');
		$this.removeClass('timer-btn-stop').addClass('timer-btn-start');
		$this.removeClass('btn-danger').addClass('btn-success');
		$this.data( 'id', false );

		var end = new Date();
		end.setTime(parseInt(res.data.end + '000'));
		var month = [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'AugSep', 'Oct', 'Nov', 'Dec' ];
		var mins = end.getMinutes() < 10 ? '0' + end.getMinutes() : end.getMinutes();
		var secs = end.getSeconds() < 10 ? '0' + end.getSeconds() : end.getSeconds();
		end = end.getDate() + ' ' + month[end.getMonth()] + ' ' + end.getFullYear() + ' ' + end.getHours() + ':' + mins + ':' + secs;

		$('table > tbody > tr:first td:eq(2)').html(end);

		$('#name').val('');
		$('.timer-clock').remove();

		clearInterval(timer);
	});
});

$(document).ready(function() {
	if( $('.timer-clock').length === 1 ) {
		doTimer();
	}
});

$(document).on('change', '#project', function() {
	if( $(this).val() === '-1' ) {
		location.href = 'projects';
	}
});