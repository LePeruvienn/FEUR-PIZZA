
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 22px;
      text-align: center;
    }

    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #333;
      color: #fff;
    }      
    .buttonReturn{
          position: absolute;
          margin-top: -10px;
          margin-left: 10px;
      }

  </style>
<body>
<ul class="buttonReturn">
        <li><a class="deco" href="index.php"> RETOUR A L'ACCEUIL </a></li>
    </ul>
  <header>
    <h1>Alerts</h1>
  </header>

  <table>
    <thead>
      <tr>
        <th>numAlerte</th>
        <th>dateAlerte</th>
        <th>message</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($AllAlerte as $alerte): ?>
        <tr>
            <td><?php echo $alerte->get('numAlerte'); ?></td>
            <td><?php echo $alerte->get('dateAlerte'); ?></td>
            <td><?php echo $alerte->get('message'); ?></td>
      
           
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>