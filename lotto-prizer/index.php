<h3>Lotto Give Prize</h3>
<div class="container1">
    Format: "Number":"Owner","Number2":"Owner2","Number3":"Owner3"
    <form id="form2" method="POST" action="nyah.php">
      <h2> Sorteos Disponibles</h2>
    <pre>
      0 -> Internal
      1 -> Navidad (API El Pais)
      2 -> El Ni&ntilde;o (API El Pais)
    </pre>
        <div>Sorteo:
          <select  name="sorteo">
            <option value="0">Internal</option>
            <option value="1">Navidad</option>
            <option value="2">El Ni&ntilde;o</option>
          </select>
        </div>
        <div>CSV Numeros: <textarea name="csv"></textarea></div>
        <div>CSV Premios: <textarea name="premios"></textarea></div>
        <input type="submit" value="Enviar CSV">
    </form>
</div>
