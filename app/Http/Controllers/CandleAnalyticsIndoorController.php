<?php

namespace App\Http\Controllers;

use App\CandleAnalyticsIndoor;
use App\CandleAnalyticsTime;
use App\Locations;
use Illuminate\Http\Request;

class CandleAnalyticsIndoorController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Pages Details & SEO
        $pages  = array(
            'name'          => 'Candle Indoor Analytics Stats',
            'title'         => 'Candle Indoor Analytics Stats',
            'fb_title'      => 'Candle Apps Dashboard',
            'tw_title'      => 'Candle Apps Dashboard',
            'description'   => 'Candle Apps Dashboard is platform consiting of the Apps under the Candle INC.',
            'tags'          => 'candle, ooh, apps, candle apps, ooh apps, candle ooh app, ',
            'image'         => '//www.candle.media/images/social-image.jpg',
            'author'        => config('app.name')
        );

        $canalytics = CandleAnalyticsIndoor::latest()->paginate(50);
  
        return view('canalytics_indoor.index',compact('canalytics', 'pages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pages  = array(
            'name'          => 'Candle Indoor Analytics Stats',
            'title'         => 'Candle Indoor Analytics Stats',
            'fb_title'      => 'Candle Apps Dashboard',
            'tw_title'      => 'Candle Apps Dashboard',
            'description'   => 'Candle Apps Dashboard is platform consiting of the Apps under the Candle INC.',
            'tags'          => 'candle, ooh, apps, candle apps, ooh apps, candle ooh app, ',
            'image'         => '//www.candle.media/images/social-image.jpg',
            'author'        => config('app.name')
        );

        $locations      = Locations::all();
        $analytics_time = CandleAnalyticsTime::all();

        return view('canalytics_indoor.create',compact('pages', 'locations', 'analytics_time'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'time_id'           => 'required', 'string', 'max:3',
            'location_id'       => 'required', 'string', 'max:10',
            'num_persons'       => 'required', 'string', 'max:3',
            'soe_a'             => 'required', 'string', 'max:3',
            'soe_b'             => 'required', 'string', 'max:3',
            'soe_c'             => 'required', 'string', 'max:3',
            'soe_d'             => 'required', 'string', 'max:3',
            'soe_e'             => 'required', 'string', 'max:3',
            'soe_f'             => 'required', 'string', 'max:3',
            'gender_male'       => 'required', 'string', 'max:3',
            'gender_female'     => 'required', 'string', 'max:3',
            'show_at'           => 'required', 'string', 'max:15',
        ]);

        CandleAnalyticsIndoor::create([
            'an_time_id'            => $request->time_id,
            'an_location_id'        => $request->location_id,
            'an_number_persons'     => $request->num_persons,
            'an_soe_a'              => $request->soe_a,
            'an_soe_b'              => $request->soe_b,
            'an_soe_c'              => $request->soe_c,
            'an_soe_d'              => $request->soe_d,
            'an_soe_e'              => $request->soe_e,
            'an_soe_f'              => $request->soe_f,
            'an_gender_male'        => $request->gender_male,
            'an_gender_female'      => $request->gender_female,
            'an_date_added'         => $request->show_at,
        ]);

        return redirect()->route('canalytics_indoor.index')
                    ->with('success','Candle Indoor Analytic stat created successfully.');

 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(CandleAnalyticsIndoor $canalytic_indoor)
    public function edit($canalytic_indoor)
    {

        $canalytic_indoor = CandleAnalyticsIndoor::find($canalytic_indoor);

        $pages  = array(
            'name'          => 'Candle Indoor Analytics Stats',
            'title'         => 'Candle Indoor Analytics Stats',
            'fb_title'      => 'Candle Apps Dashboard',
            'tw_title'      => 'Candle Apps Dashboard',
            'description'   => 'Candle Apps Dashboard is platform consiting of the Apps under the Candle INC.',
            'tags'          => 'candle, ooh, apps, candle apps, ooh apps, candle ooh app, ',
            'image'         => '//www.candle.media/images/social-image.jpg',
            'author'        => config('app.name')
        );

        $locations      = Locations::all();
        $analytics_time = CandleAnalyticsTime::all();

        return view('canalytics_indoor.edit',compact('canalytic_indoor', 'pages', 'locations', 'analytics_time'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, CandleAnalyticsIndoor $canalytic_indoor)
    public function update(Request $request, $canalytic_indoor)
    {

        $request->validate([
            'time_id'           => 'required', 'string', 'max:10',
            'location_id'       => 'required', 'string', 'max:10',
            'num_persons'       => 'required', 'string', 'max:3',
            'soe_a'             => 'required', 'string', 'max:3',
            'soe_b'             => 'required', 'string', 'max:3',
            'soe_c'             => 'required', 'string', 'max:3',
            'soe_d'             => 'required', 'string', 'max:3',
            'soe_e'             => 'required', 'string', 'max:3',
            'soe_f'             => 'required', 'string', 'max:3',
            'gender_male'       => 'required', 'string', 'max:3',
            'gender_female'     => 'required', 'string', 'max:3',
            'show_at'           => 'required', 'string', 'max:15',
        ]);

        // $canalytic_indoor->update([
        CandleAnalyticsIndoor::find($canalytic_indoor)->update([
            'an_time_id'            => $request->time_id,
            'an_location_id'        => $request->location_id,
            'an_number_persons'     => $request->num_persons,
            'an_soe_a'              => $request->soe_a,
            'an_soe_b'              => $request->soe_b,
            'an_soe_c'              => $request->soe_c,
            'an_soe_d'              => $request->soe_d,
            'an_soe_e'              => $request->soe_e,
            'an_soe_f'              => $request->soe_f,
            'an_gender_male'        => $request->gender_male,
            'an_gender_female'      => $request->gender_female,
            'an_date_added'         => $request->show_at,
        ]);

        // CandleAnalyticsIndoor::find($canalytic_indoor)->update($request->all());

        return redirect()->route('canalytics_indoor.index')
                    ->with('success','Candle Indoor Analytic stats updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(CandleAnalyticsIndoor $canalytic)
    public function destroy($canalytic)
    {

        $canalytic = CandleAnalyticsIndoor::where('id',$canalytic)->first();

        if ($canalytic != null) 
        {
            $canalytic->delete();
            return redirect()->route('canalytics_indoor.index')
                        ->with('success','Selected Candle Indoor Analytic stats successfully deleted');
        }
        return redirect()->route('canalytics_indoor.index')
                        ->with('error','Invalid ID');

    }
}
