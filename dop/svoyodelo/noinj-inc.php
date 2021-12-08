<?  function escape_inj ($text) {
				  $text = strtolower($text); // Приравниваем текст параметра к нижнему регистру
				  if (
				    !strpos($text, "select") && //
				    !strpos($text, "union") && //
				    !strpos($text, "select") && //
				    !strpos($text, "order") && // Ищем вхождение слов в параметре
				    !strpos($text, "where") && //
				    !strpos($text, "char") && //
				    !strpos($text, "from")
				  ) {
				    return true; // Вхождений нету - возвращаем true
				  } else {
				    return false; // Вхождения есть - возвращаем false
				  }
				}
?>