<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Evenement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File; 

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $evenements = Evenement::orderByDesc('date')->get();
            return Inertia::render('Admin/Adminevent', [
                'evenements' => $evenements
            ]);
    }

    public function indexPublic(){

            $now = Carbon::now();
            $thirtyDaysFromNow = $now->copy()->addDays(30);
            $evenements = Evenement::where('date','>',$now)
            ->where('date', '<', $thirtyDaysFromNow)
            ->orderByDesc('date')
            ->get();
            return Inertia::render('Programme',[
                'evenements' => $evenements
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $evenement = Evenement::create($data);
        return redirect()->back();
    }

    public function createRecurringEvent(Request $request)
{
    $selectedDayOfWeek = $request->input('selected_day');
    $currentDate = Carbon::now();

    // Obtenez le premier jour de la semaine courante
    $startDate = $currentDate->copy()->startOfWeek();

    // Tableau de correspondance des noms de mois
    $monthNames = [
        'January' => 'janvier',
        'February' => 'février',
        'March' => 'mars',
        'April' => 'avril',
        'May' => 'mai',
        'June' => 'juin',
        'July' => 'juillet',
        'August' => 'août',
        'September' => 'septembre',
        'October' => 'octobre',
        'November' => 'novembre',
        'December' => 'décembre',
    ];

    $endDate = $currentDate->copy()->addMonth();

    $dates = [];

    while ($startDate->lte($endDate)) {
        if ($startDate->dayOfWeek == $selectedDayOfWeek) {
            $dates[] = $startDate->copy();
        }
        $startDate->addDay();
    }

    foreach ($dates as $date) {
        $data = [
            'nom' => $request->input('nom'),
            'heure' => $request->input('heure'),
            'metro' => $request->input('metro'),
            'lieu' => $request->input('lieu'),
            'jour' => $date->day, // Jour du mois
            'mois' => $monthNames[$date->format('F')], // Mise à jour du mois
            'date' => $date,
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        Evenement::create($data);
    }

    return redirect()->back();
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $evenement = Evenement::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $evenement->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();

        $imagePath = 'storage/images/' . basename($evenement->image);
        if(File::exists($imagePath)){
        File::delete($imagePath);
        }

        return redirect()->back();
    }
}
