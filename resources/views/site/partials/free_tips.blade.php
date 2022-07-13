<div id="pricing" class="pricing-area area-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-left">
                    <h3>Free Singles</h3>
                </div>
            </div>
        </div>
        <div class="row">


<table role="table" border="1" width="100%">
  <thead role="rowgroup">
    <tr role="row">
      <th role="columnheader" data-*="First Name">Date</th>
      <th role="columnheader">Match</th>
      <th role="columnheader">Prediction</th>
    </tr>
  </thead>
  <tbody role="rowgroup">

  @foreach($free_tips as $tip)
    <tr role="row">
      <td role="cell">{{ $tip->game_date }}</td>
      <td role="cell">{{ $tip->match }}</td>
      <td role="cell">{{$tip->prediction}}</td>
    </tr>
  @endforeach
    
  </tbody>
</table>
           
        </div>
    </div>
</div>