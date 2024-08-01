<?php
session_start();


function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) { ?>
          <div class="flash__alert">
              <?=$_SESSION['flash']?>
          </div>
        <?php }
        unset($_SESSION['flash']);
    }
}

function include_template($file_name) {
    include __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $file_name;
}

/**
 * Преобразование секунд в секунды/минуты/часы/дни/года
 * 
 * @param int $seconds - секунды для преобразования
 *
 * @return array $times:
 *		$times[0] - секунды
 *		$times[1] - минуты
 *		$times[2] - часы
 *		$times[3] - дни
 *		$times[4] - года
 *
 */
function seconds2times($seconds)
{
	$times = array();
	
	// считать нули в значениях
	$count_zero = false;
	
	// количество секунд в году не учитывает високосный год
	// поэтому функция считает что в году 365 дней
	// секунд в минуте|часе|сутках|году
	$periods = array(60, 3600, 86400, 31536000);
	
	for ($i = 3; $i >= 0; $i--)
	{
		$period = floor($seconds/$periods[$i]);
		if (($period > 0) || ($period == 0 && $count_zero))
		{
			$times[$i+1] = $period;
			$seconds -= $period * $periods[$i];
			
			$count_zero = true;
		}
	}
	
	$times[0] = $seconds;
	return $times;
}