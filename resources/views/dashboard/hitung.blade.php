@extends('dashboard.layouts.dashboardmain')
@section('title', 'Hitung')
@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3 overflow-x-hidden">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex justify-between p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="dark:text-white">Matriks Penilaian</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-6 overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 overflow-x-auto align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Alternatif</th>
                                    @foreach ($criteria as $c)
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            {{ $c->criteria_code }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $a)
                                    <tr>
                                        <td
                                            class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $a->alternatif_code }}
                                            </span>
                                        </td>
                                        @foreach ($criteria as $c)
                                            @php
                                                $penilaianForCriteria = $penilaian
                                                    ->where('id_alternatif', $a->id)
                                                    ->where('id_criteria', $c->id)
                                                    ->first();
                                            @endphp

                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <span
                                                    class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                    {{ $penilaianForCriteria ? $penilaianForCriteria->nilai : 0 }}
                                                </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Matriks Normalisasi ========== -->
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3 overflow-x-hidden">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div
                    class="flex justify-between p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="dark:text-white">Normalisasi</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-6 overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 overflow-x-auto align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Alternatif</th>
                                    @foreach ($criteria as $c)
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            {{ $c->criteria_code }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $keyRow => $a)
                                    <tr>
                                        <td
                                            class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $a->alternatif_code }}
                                            </span>
                                        </td>
                                        @foreach ($criteria as $keyColumn => $c)
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <span
                                                    class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                    {{ $normalisasi[$keyRow][$keyColumn] }}
                                                </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ========== Matriks Normalisasi terbobot ========== -->
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3 overflow-x-hidden">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div
                    class="flex justify-between p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="dark:text-white">Normalisasi Terbobot</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-6 overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 overflow-x-auto align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Alternatif</th>
                                    @foreach ($criteria as $c)
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            {{ $c->criteria_code }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $keyRow => $a)
                                    <tr>
                                        <td
                                            class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $a->alternatif_code }}
                                            </span>
                                        </td>
                                        @foreach ($criteria as $keyColumn => $c)
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <span
                                                    class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                    {{ $weightedNormalization[$keyRow][$keyColumn] ?? 'N/A' }}
                                                </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ========== SI Dan RI ========== -->
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3 overflow-x-hidden">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div
                    class="flex justify-between p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="dark:text-white">Tabel SI Dan RI</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-6 overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 overflow-x-auto align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        SI</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        RI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $key => $a)
                                    <tr>
                                        <td
                                            class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $Si[$key] ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $Ri[$key] ?? 'N/A' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== Perangkingan ========== -->
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3 overflow-x-hidden">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div
                    class="flex justify-between p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="dark:text-white">Tabel Ranking</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-6 overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 overflow-x-auto align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Alternatif</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Value</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Ranking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $key => $a)
                                    <tr>
                                        <td
                                            class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $a->alternatif_code }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ $finalValues[$key] ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-3 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                {{ array_search($finalValues[$key], $ranking) + 1 ?? 'N/A' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
