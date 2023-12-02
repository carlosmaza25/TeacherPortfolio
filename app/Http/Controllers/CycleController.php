<?php

namespace App\Http\Controllers;

use App\Models\CycleDetail;
use App\Models\PeriodDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SocialProfile;
use Carbon\Carbon;
use COM;
use Exception;

class CycleController extends Controller
{
    public $rules , $messages ;
    public $cycle , $sincecycle , $untilcycle , $year , $sinceperiodone , $untilperiodone ,
            $sinceperiodtwo , $untilperiodtwo , $sinceperiodthree , $untilperiodthree;

    public function Cycle(){

        $id = session('id') ; 
        $name = session('name');
        $socialProfile =  SocialProfile::where('teacherid' , $id)->first() ;
        $Periodsdetail =  PeriodDetail::latest('perioddetailid')->take(6)->get();

        return view('Admin.cycle' ,  compact('socialProfile' , 'name' , 'id' , 'Periodsdetail'));
    }

    //-------------------------------------------Metodo para Crear un nuevo Ciclo.---------------------------------------------------------//

    public function save(Request $request) {
        
        $today = Carbon::today()->toDateString();
        $this->cycle = (int)$request->input('cycle');
        $this->sincecycle = $request->input('start');
        $this->untilcycle = $request->input('end');
        $this->year = explode('-' , $this->sincecycle);
        $this->sinceperiodone = $request->input('startperiodone');
        $this->untilperiodone = $request->input('endperiodone');
        $this->sinceperiodtwo = $request->input('startperiodtwo');
        $this->untilperiodtwo = $request->input('endperiodtwo');
        $this->sinceperiodthree = $request->input('startperiodthree');
        $this->untilperiodthree = $request->input('endperiodthree');

        $cycles = CycleDetail::where('cycleid' , $this->cycle)->where('year' , $this->year[0])->count();
        if ($cycles >= 1){
            $this->messages = 'No puede existir otro ciclo ' . $this->cycle . ' en el año ' . $this->year[0] . ' Cambie el ciclo o seleccione fechas diferentes';
                return redirect()->back()->with('cycleexists' , $this->messages)->withInput();
        }
        else {
                //----------------------------------------------este if valida si no se ha seleccionado ningun ciclo y en ese caso guarda por defecto el registro con el ciclo 1.

                    if ($this->cycle === '' || $this->cycle === null) {
                        $this->cycle = 1 ;
                    }
        
                //------------------------------------------Estos if Validan si las fechas estan vacias y envia un mensaje a la vista advirietndo que debe establecer una fecha..
        
                    if (empty($this->sincecycle)){
                        $this->messages = 'Debe Proporcionar una fecha.';
                        return redirect()->back()->with('sincecycle' , $this->messages)->withInput();
                    }
                    if (empty($this->untilcycle)){
                        $this->messages = 'Debe Proporcionar una fecha.';
                        return redirect()->back()->with('untilcycle' , $this->messages)->withInput();
                    }
                    if (empty($this->sinceperiodone)){
                        $this->messages = 'Debe Proporcionar una fecha.';
                        return redirect()->back()->with('sinceperiodone' , $this->messages)->withInput();
                    }
                    if (empty($this->untilperiodone)){
                        $this->messages = 'Debe Proporcionar una fecha.';
                        return redirect()->back()->with('untilperiodone' , $this->messages)->withInput();
                    }
                    if (empty($this->sinceperiodtwo)){
                        $this->messages = 'Debe Proporcionar una fecha.';
                        return redirect()->back()->with('sinceperiodtwo' , $this->messages)->withInput();
                    }
                    if(empty($this->untilperiodtwo)){
                        $this->messages = 'Debe Proporcionar una fecha.';
                        return redirect()->back()->with('untilperiodtwo' , $this->messages)->withInput();
                    }
                    if (empty($this->sinceperiodthree)){
                        $this->messages = 'Debe Proporcionar una fecha.';
                        return redirect()->back()->with('sinceperiodthree' , $this->messages)->withInput();
                    }
                    if (empty($this->untilperiodthree)){
                        $this->messages = 'Debe Proporcionar una fecha.';
                        return redirect()->back()->with('untilperiodthree' , $this->messages)->withInput();
                    }
        
                //-------------------------------Se verifica si la esta dentro de un rango de fechas logico-----------------------------------------------//
        
                    if (Carbon::parse($this->sincecycle)->lessThan($today)){
                        $this->messages = 'la fecha de inicio de ciclo no puede ser menor a la fecha actual.';
                        return redirect()->back()->with('sincecycle' , $this->messages)->withInput();
                    }
                    else if (Carbon::parse($this->sinceperiodone)->lessThan(Carbon::parse($this->sincecycle))){
                        $this->messages = 'el Inicio del periodo uno no puede ser una fecha anterior a al Inicio del ciclo.';
                        return redirect()->back()->with('sinceperiodone' , $this->messages)->withInput();
                    }
        
                    else if (Carbon::parse($this->untilperiodone)->greaterThan(Carbon::parse($this->untilcycle))){
                        $this->messages = 'el Final del periodo uno no puede ser una fecha posterior a al final del ciclo.';
                        return redirect()->back()->with('untilperiodone' , $this->messages)->withInput();
                    }
        
                    else if (Carbon::parse($this->sinceperiodtwo)->lessThan(Carbon::parse($this->untilperiodone)) || Carbon::parse($this->sinceperiodtwo)->greaterThan(Carbon::parse($this->untilcycle))){
                        $this->messages = 'El periodo 2 no puede inciar antes de finalizar el periodo uno y tampoco puede iniciar despues del final del ciclo.';
                        return redirect()->back()->with('sinceperiodtwo' , $this->messages)->withInput();
                    }
        
                    else if (Carbon::parse($this->untilperiodtwo)->lessThan(Carbon::parse($this->sinceperiodtwo)) || Carbon::parse($this->untilperiodtwo)->greaterThan(Carbon::parse($this->untilcycle))){
                        $this->messages = 'El periodo 2 no puede finalizar antes de iniciar y tampoco puede finalizar despues del final del ciclo.';
                        return redirect()->back()->with('untilperiodtwo' , $this->messages)->withInput();
                    }
        
                    else if (Carbon::parse($this->sinceperiodthree)->lessThan(Carbon::parse($this->untilperiodtwo)) || Carbon::parse($this->sinceperiodthree)->greaterThan(Carbon::parse($this->untilcycle))){
                        $this->messages = 'El periodo 3 no puede inciar antes de finalizar el periodo 2 y tampoco puede iniciar despues del final del ciclo.';
                        return redirect()->back()->with('sinceperiodthree' , $this->messages)->withInput();
                    }
        
                    else if (Carbon::parse($this->untilperiodthree)->lessThan(Carbon::parse($this->sinceperiodthree)) || Carbon::parse($this->untilperiodthree)->greaterThan(Carbon::parse($this->untilcycle))){
                        $this->messages = 'El periodo 3 no puede finalizar antes de iniciar y tampoco puede finalizar despues del final del ciclo.';
                        return redirect()->back()->with('untilperiodthree' , $this->messages)->withInput();
                    }
        
            //------------------------------------------ dentro del else se procede a Guradar los datos dentro de la base de datos.---------------------------------------------------//
        
                    else {
                        CycleDetail::create([
                            'cycleid' => $this->cycle,
                            'since' => $this->sincecycle,
                            'until' => $this->untilcycle,
                            'year' => $this->year[0],
                        ]);
                
                        DB::beginTransaction();
                
                        try {
                
                            PeriodDetail::create([
                                'cycleid' => $this->cycle,
                                'periodid' => 1,
                                'since' => $this->sinceperiodone,
                                'until' => $this->untilperiodone,
                                'year' => $this->year[0],
                            ]);
                
                            PeriodDetail::create([
                                'cycleid' => $this->cycle,
                                'periodid' => 2,
                                'since' => $this->sinceperiodtwo,
                                'until' => $this->untilperiodtwo,
                                'year' => $this->year[0],
                            ]);
                
                            PeriodDetail::create([
                                'cycleid' => $this->cycle,
                                'periodid' => 3,
                                'since' => $this->sinceperiodthree,
                                'until' => $this->untilperiodthree,
                                'year' => $this->year[0],
                            ]);
                
                            DB::commit();
        
                            return redirect()->route('admin.cycle');
                
                        }catch(Exception $e) {
                            DB::rollback();
                            throw $e;
                    }
                }
        }
    }

    public function edit (PeriodDetail $period) {
        return view('Admin.editcycle' , compact('period'));
    }
}
